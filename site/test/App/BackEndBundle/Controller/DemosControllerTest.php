<?php 

namespace Test\App\BackEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Client;
use App\BackEndBundle\Entity\Demos;

class DemosControllerTest extends WebTestCase
{
    const BASE_PATH='/api/demos';
    const HEADER=array('CONTENT_TYPE' => 'application/json');
    private $client,$em;

    protected function setUp(): void
    {
        static::bootKernel();
        $this->client = static::createClient();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    /**
     * @test
     */
    public function ifExistEndPoint()
    {
        $this->client->request('GET', self::BASE_PATH);
        $this->assertNotEquals(404, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function failureEmptyBody()
    {
        $this->client->request('POST',self::BASE_PATH,[],[],self::HEADER,'');
        $this->assertJsonResponse($this->client->getResponse(), 400);
    }

//    /*/**
//     * @test
//     */
//    public function failureNameEmpty()
//    {
//        $this->client->request('POST',self::BASE_PATH,[],[],self::HEADER,json_encode([
//            'name'=>''
//        ]));
//        $this->assertJsonResponse($this->client->getResponse(), 400);
//        $this->assertTrue($this->checkErrorForm($this->client->getResponse(),'name','This value should not be blank.'));
//    }
//
//    /**
//     * @test
//     */
//    public function failureNameShort()
//    {
//        $this->client->request('POST',self::BASE_PATH,[],[],self::HEADER,json_encode([
//            'name'=>'AB',
//            'country'=>'das'
//        ]));
//        $this->assertJsonResponse($this->client->getResponse(), 400);
//        $this->assertTrue($this->checkErrorForm($this->client->getResponse(),'name','This value is too short. It should have 3 characters or more.'));
//    }
//
//    /**
//     * @test
//     */
//    public function failureNameLong()
//    {
//        $this->client->request('POST',self::BASE_PATH,[],[],self::HEADER,json_encode([
//            'name'=>'ABCDEFGHIJQLMNOPQRSTUVWXYZABCDEFGHIJQLMNOPQRSTUVWXYZABCDEFGHIJQLMNOPQRSTUVWXYZABCDEFGHIJQLMNOPQRSTUVWXYZ'
//        ]));
//        $this->assertJsonResponse($this->client->getResponse(), 400);
//        $this->assertTrue($this->checkErrorForm($this->client->getResponse(),'name','This value is too long. It should have 64 characters or less.'));
//    }
//
//    /**
//     * @test
//     */
//    public function failureCountryInvalid()
//    {
//        $this->client->request('POST',self::BASE_PATH,[],[],self::HEADER,json_encode([
//            'country'=>'aaaa'
//        ]));
//        $this->assertJsonResponse($this->client->getResponse(), 400);
//        $this->assertTrue($this->checkErrorForm($this->client->getResponse(),'country','This value is not valid.'));
//    }
//
//    /**
//     * @test
//     */
//    public function failureSkillsInvalid()
//    {
//        $this->client->request('POST',self::BASE_PATH,[],[],self::HEADER,json_encode([
//            'skills'=>['aaaa']
//        ]));
//        $this->assertJsonResponse($this->client->getResponse(), 400);
//        $this->assertTrue($this->checkErrorForm($this->client->getResponse(),'skills','This value is not valid.'));
//    }
//
//    /**
//     * @test
//     */
//    public function successMinimalPost()
//    {
//        $this->client->request('POST',self::BASE_PATH,[],[],self::HEADER,json_encode([
//            'name'=>'TestSuccessMinimalPost'
//        ]));
//        $this->assertJsonResponse($this->client->getResponse(), 201);
//    }
//
//    /**
//     * @test
//     */
//    public function successCompletePost()
//    {
//        $country=$this->em->getRepository(Countries::class)->getAll()->andWhere('e.name=:name')->setParameter('name','Argentina')->setMaxResults(1)
//            ->getQuery()->getOneOrNullResult();
//        $skillsObjets=$this->em->getRepository(Skills::class)->getAll()->setMaxResults(10)
//            ->getQuery()->getResult();
//        $skills=[];
//        foreach($skillsObjets as $skill)
//            $skills[]=$skill->getId();
//        $this->client->request('POST',self::BASE_PATH,[],[],self::HEADER,json_encode([
//            'name'=>'TestSuccessCompletePost',
//            'country'=>$country->getId(),
//            'skills'=>$skills
//        ]));
//        $this->assertJsonResponse($this->client->getResponse(), 201);
//    }
//
//    /**
//     * @test
//     */
//    public function failureGet()
//    {
//        $this->client->request('GET',self::BASE_PATH."/1111-2222-3333-4444",[],[],self::HEADER);
//        $this->assertJsonResponse($this->client->getResponse(), 404);
//    }
//
//    /**
//     * @test
//     */
//    public function successGet()
//    {
//        $entity=$this->em->getRepository(Demo::class)->findOneByName("TestSuccessCompletePost");
//        $this->client->request('GET',self::BASE_PATH."/".$entity->getId(),[],[],self::HEADER);
//        $this->assertJsonResponse($this->client->getResponse(), 200);
//    }
//
//    /**
//     * @test
//     */
//    public function successDelete()
//    {
//        $entity=$this->em->getRepository(Demo::class)->findOneByName("TestSuccessCompletePost");
//        $this->client->request('DELETE',self::BASE_PATH."/".$entity->getId(),[],[],self::HEADER);
//        $this->assertJsonResponse($this->client->getResponse(), 200);
//    }
//
//    /**
//     * @test
//     */
//    public function successDeleteHard()
//    {
//        $entity=$this->em->getRepository(Demo::class)->findOneByName("TestSuccessMinimalPost");
//        $this->client->request('DELETE',self::BASE_PATH."/".$entity->getId()."/hard",[],[],self::HEADER);
//        $this->assertJsonResponse($this->client->getResponse(), 200);
//    }
//
    protected function assertJsonResponse($response, $statusCode = 200){
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }
//
//    protected function checkErrorForm($response,$field,$message){
//        try{
//            return (json_decode($response->getContent(),true)['form']['errors']['children'][$field]['errors'][0]===$message);
//        } catch (\Throwable $th) {
//            return false;
//        }
//    }*/
   
}