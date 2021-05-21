<?php
namespace Apachecms\FrontendBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\Query\Expr;

/**
 * Listado de land page por categorias
 * Class ListController
 * @package Apachecms\FrontendBundle\Controller
 */
class ListLandingController extends Controller{
    /*
    public function indexAction(Request $request){
        #$landings=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->findBy([],null,9);
        $landings = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->findByCountryAndIndustry();
        $builder = $this->buildFormSearch($this->createFormBuilder());

        return $this->render('ApachecmsFrontendBundle:ListLanding:index.html.twig',
            ['landings'=>$landings,
            'total'=>9,
            'nearbyPagesLimit'=>5,
            'current'=>1,
            'form'=>$builder->getForm()->createView()]);
    }*/

    public function navAction($industry,$industry_name, $country,$country_name, $page, Request $request){
        $page=$page-1;
        if($industry =='0'){
            $industry=0;
        }
        if($country =='0'){
            $country=0;
        }

        $total_per_page= 9;
        $where=[];
        if($industry>0){
            $where['industry']=$industry;
        }
        $offset = $page>0 ? $total_per_page*$page : 0;
        $limit  = $total_per_page;
        $repo_landing= $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing');
        $landings = $repo_landing
            ->findByCountryAndIndustry($country,$industry,$offset, $limit);

        #$landings=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->findBy($where,null,$total_per_page,$total_per_page*$page);
        $builder = $this->buildFormSearch($this->createFormBuilder());
        $form = $builder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parameters = $form->getData();
            //var_dump($filter);exit;
            $parameters['page']=1;
            //TODO poner nombre
            $parameters['industry_name']='la';
            $parameters['country_name']='la';
            return $this->redirectToRoute('apachecms_frontend_landings_nav',$parameters);
        }
        $industries = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Industry')->findAll();
        $countries = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Country')->getAllActive();


        $total_pages = ceil($repo_landing->countByCountryAndIndustry($country,$industry)/$total_per_page);
        return $this->render('ApachecmsFrontendBundle:ListLanding:index.html.twig',
            [   'landings'=>$landings,
                'countries'=> $countries ,
                'industries'=>$industries,
                'industry_id_page'=>$industry,
                'industry_name_page'=>$industry_name,
                'country_name_page'=>$country_name,
                'country_id_page'=>$country,
                'total'=>$total_pages,
                'nearbyPagesLimit'=>5,
                'current'=>$page+1,
                'form'=>$form->createView()
            ]);
    }
    public function seoAction(){
        $industries = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Industry')->findAll();
        $countries = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Country')->getAllActive();

        $countries[]=['id'=>0,'name'=>'Todos'];
        $industries[]=['id'=>0,'name'=>'Todos'];
        return $this->render('ApachecmsFrontendBundle:ListLanding:seo.html.twig',
            [
                'countries'=> $countries ,
                'industries'=>$industries]);
    }
    protected function buildFormSearch($builder){
        /* @var $entityManager Doctrine\ORM\EntityManager */
        $entityManager = $this->getDoctrine()->getManager();
        $industries = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Industry')->findAll();
        $countries = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Country')->getAllActive();

        $choices_industries['Todos']=0;
        $choices_countries['Todos']=0;

        foreach ($industries as $industry ){
            $choices_industries[$industry->getName()]=$industry->getId();
        }
        foreach ($countries as $country){
            $choices_countries[$country->getName()]=$country->getId();
        }
        $builder->add('industry', ChoiceType::class, [
            'label'=>'Industrias',
            'attr'=>['class'=>'form-control'],

            'choice_attr' => function($choice, $key, $value) {
                // adds a class like attending_yes, attending_no, etc
                return ['class' => 'form-check-input'];
            },
            //'label_attr'=>['class' => 'btn btn-primary'],
            'choices'  => $choices_industries
        ]);
        /*$builder->add('Fecha', ChoiceType::class, [
            'attr'=>['class'=>'form-control'],

            'choices'  =>
                ['Hoy'=>strtotime('today'),
                    'Esta Semana'=>strtotime('-1 week'),
                    'Ultimo Mes'=>strtotime('-1 month'),
                    'Últimos 6 meses'=>strtotime('-6 month'),
                    'Todos los tiempos'=>0
                ]
        ]);*/
        $builder->add('country',ChoiceType::class,[
            'label' => 'Paises',
            'attr'=>['class'=>'form-control selectpicker'],
            'choices' => $choices_countries
        ]);

        $builder->add('Buscar', SubmitType::class, [
            'attr' => ['class' => 'btn btn-primary mb-2'],
        ]);

        return $builder;
    }
}