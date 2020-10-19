<?php
// src/Controller/ApiController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\ClassSubject;
use App\Entity\ClassTopic;
use App\Entity\ClassTimeslot;
use App\Entity\Student;
use App\Entity\StudentTimeslot;

class ApiController extends AbstractController
{
    /**
      * @Route("/api/create")
      */
    public function admin_create(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $response = new \stdClass(); // start object for response
        $type = $data['type']; // determine which type of data will be added

        if (empty($type)) { // reject request
            $response->type = $type;
            $response->status = true;
            $response->message = $type . " Added Successfully";
        } else {
            
            switch ($type) {
                case "Subject":
                  $this->create_subject($data);
                  break;
                case "Topic":
                  $this->create_topic($data);
                  break;
                case "Timeslot":
                  $this->create_timeslot($data);
                  break;
              }

            $response->type = $type;
            $response->status = true;
            $response->message = $type . " Added Successfully";
        }

        return new JsonResponse($response, 200);
    }

    public function create_subject($data) {
        $entityManager = $this->getDoctrine()->getManager();

        $subject = new ClassSubject();
        $subject->setSubject($data['value']);
        $subject->setDateCreated(new \DateTime());
        $subject->setActive(1);

        $entityManager->persist($subject);
        $entityManager->flush();
        return true;
    }

    public function create_topic($data) {
        $entityManager = $this->getDoctrine()->getManager();

        $topic = new ClassTopic();
        $topic->setTopic($data['value']);
        $topic->setSubjectId($data['subject_id']);
        $topic->setDateCreated(new \DateTime());
        $topic->setActive(1);

        $entityManager->persist($topic);
        $entityManager->flush();
        return true;
        
    }

    public function create_timeslot($data) {
        $entityManager = $this->getDoctrine()->getManager();

        $timeslot = new ClassTimeslot();
        $timeslot->setTimeslot($data['value']);
        $timeslot->setTopicId($data['topic_id']);
        $timeslot->setDateCreated(new \DateTime());
        $timeslot->setActive(1);

        $entityManager->persist($timeslot);
        $entityManager->flush();
        return true;
        
    }

    /**
      * @Route("/api/find-user/{username}/{email}")
      */
      public function admin_find_user($username, $email)
      {
        $response = new \stdClass(); // start object for response
  
        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery('SELECT s FROM App\Entity\Student s WHERE s.username = :username AND s.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $email);
        $user = $query->getResult();

        if (empty($user)) {
            $student = new Student();
            $student->setUsername($username);
            $student->setEmail($email);
            $student->setDateCreated(new \DateTime());
            $student->setActive(1);

            $entityManager->persist($student);
            $entityManager->flush();
            $id = $student->getId();

            $response->student_id = $id;
            $response->status = true;
            $response->message = "Student Added Successfully";
        } else {
            $response->student_id = $user[0]->getId();
            $response->status = true;
            $response->message = "Student Account Found";
        }
  
        return new JsonResponse($response, 200);
      }

      /**
      * @Route("/api/find-schedule/{student_id}")
      */
      public function admin_find_schedule($student_id)
      {
        $response = new \stdClass();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("
        SELECT tp.id, tp.topic, c.topic_id, c.timeslot, su.id, su.subject
        FROM App\Entity\StudentTimeslot s
        INNER JOIN App\Entity\ClassTimeslot c
        INNER JOIN App\Entity\ClassTopic tp
        INNER JOIN App\Entity\ClassSubject su
        WHERE s.student_id = ".$student_id."
        AND s.timeslot_id = c.id
        AND c.topic_id = tp.id
        and tp.subject_id = su.id
        ");
        $schedule = $query->getArrayResult();
        
        if (empty($schedule)) {
            $response->schedule = NULL;
            $response->status = false;
            $response->message = "You have not enrolled in any classes";
        } else {
            $response->schedule = $schedule;
            $response->status = True;
            $response->message = "Class Schedule Found!";
        }

        return new JsonResponse($response, 200);
      }

      /**
      * @Route("/api/find-subjects")
      */
      public function admin_find_subjects()
      {
        $response = new \stdClass();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT s FROM App\Entity\ClassSubject s");
        $subjects = $query->getArrayResult();
        
        $response->subjects = $subjects;
        $response->status = True;
        $response->message = "Subjects Found!";

        return new JsonResponse($response, 200);
      }

      /**
      * @Route("/api/find-topic/{id}")
      */
      public function admin_find_topics($id)
      {
        $response = new \stdClass();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("
            SELECT s 
            FROM App\Entity\ClassTopic s 
            WHERE s.subject_id = ".$id."");
        $topics = $query->getArrayResult();
        
        $response->topics = $topics;
        $response->status = True;
        $response->message = "Topics Found!";

        return new JsonResponse($response, 200);
      }

      /**
      * @Route("/api/find-timeslot/{id}")
      */
      public function admin_find_timeslot($id)
      {
        $response = new \stdClass();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("
            SELECT s 
            FROM App\Entity\ClassTimeslot s 
            WHERE s.topic_id = ".$id."");
        $timeslots = $query->getArrayResult();
        
        $response->timeslots = $timeslots;
        $response->status = True;
        $response->message = "Timeslots Found!";

        return new JsonResponse($response, 200);
      }

      /**
      * @Route("/api/add-timeslot/{student_id}/{timeslot_id}")
      */
      public function create_student_timeslot($student_id, $timeslot_id) {
        $response = new \stdClass();
        $entityManager = $this->getDoctrine()->getManager();

        $timeslot = new StudentTimeslot();
        $timeslot->setStudentId($student_id);
        $timeslot->setTimeslotId($timeslot_id);
        $timeslot->setDateCreated(new \DateTime());
        $timeslot->setActive(1);

        $entityManager->persist($timeslot);
        $entityManager->flush();
        
        $response->status = True;
        $response->message = "Timeslot Added To Schedule!";

        return new JsonResponse($response, 200);
    }

}