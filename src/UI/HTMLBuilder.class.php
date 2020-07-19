<?php

namespace UI;

class HTMLBuilder
{
    private static ?HTMLBuilder $instance = null;
    private CompositeBuilder $compositeBuilder;
    private ElementBuilder $elementBuilder;
    private array $contents = [];

    private function __construct()
    {
        $this->compositeBuilder=new CompositeBuilder();
        $this->elementBuilder= ElementBuilder::getInstance();
    }

    public static function getInstance(): HTMLBuilder
    {
        if (self::$instance == null)
            self::$instance = new self;
        return self::$instance;
    }

    public function createMainNavBar(array $navList):HTMLBuilder
    {
        $i=0;
        $navComList=[];
        foreach ($navList as $nav) {
            
            if ($i==0) {
                $this->compositeBuilder
                    ->createComposite('li',['class'=>"nav-item hvrcenter active", 'data-toggle'=>str_replace(' ','',$nav)]);
            } else {
                $this->compositeBuilder
                    ->createComposite('li',['class'=>"nav-item hvrcenter mr-2", 'data-toggle'=>str_replace(' ','',$nav)]);
            }
            
            $navCom=$this->compositeBuilder
                ->addElement('a',['class'=>'nav-link'],[$nav])
                ->getComposite();
            array_push($navComList,$navCom);
            $i++;
        }
        $mainNavBar=
        $this->compositeBuilder
            ->createComposite('nav' ,['class'=>"main-nav navbar navbar-expand-md navbar-dark py-0"])
            ->composite()
                ->createComposite('a',['class'=>"navbar-brand mr-auto" ,'href'=>"#"])
                ->addElement('img',['src'=>"../images/national-logo.png", 'class'=>"logo img-fluid"])
                ->get()
            ->composite()
                ->createComposite('button',['class'=>"navbar-toggler my-2", 'type'=>"button", 'data-toggle'=>"collapse" ,'data-target'=>"#navbarContent"])
                ->addElement('span',['class'=>"navbar-toggler-icon"])
                ->get()
            ->composite()
                ->createComposite('div',['class'=>"collapse tab-info navbar-collapse", 'id'=>"navbarContent"])
                ->composite()
                    ->createComposite('ul',['class'=>'navbar-nav ml-auto'])
                    ->addArrayToContent($navComList)
                    ->composite()
                        ->createComposite('li',['class'=>'nav-item dropdown'])
                        ->composite()
                            ->createComposite('a',['class'=>"nav-link dropdown-toggle", 'id'=>"navbarDropdownMenuLink-55", 'data-toggle'=>"dropdown", 'aria-haspopup'=>"true", 'aria-expanded'=>"false"])
                            ->addElement('img',['src'=>"../images/default-user-image.png", 'class'=>"rounded-circle user-image mt-2", 'style'=>"height:35px;"])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>"dropdown-menu dropdown-menu-lg-right dropdown-secondary profile-dropdown", 'aria-labelledby'=>"navbarDropdownMenuLink-55", 'style'=>"position:absolute"])
                            ->composite()
                                ->createComposite('div',['class'=>"user-dropdown dropdown-content"])
                                ->addElement('img',['src'=>"../images/default-user-image.png"])
                                ->composite()
                                    ->createComposite('div',['class'=>'container'])
                                    ->addElement('p')
                                    ->addElement('p',['class'=>"name-profile-dd"])
                                    ->addElement('p',['class'=>"name-profile-dd"])
                                    ->addElement('p',['class'=>"mail-profile-dd"])
                                    ->addElement('p')
                                    ->addElement('button',['type'=>"button", 'class'=>"btn btn-light mx-auto my-2", 'id'=>"edit-account-info-btn"],['Edit account info'])
                                    ->get()
                                ->get()
                            ->composite()
                                ->createComposite('div',['class'=>"footer-profile"])
                                ->addElement('a',['type'=>"button", 'class'=>"btn btn-light", 'href'=>"../func/logout.php"],['Sign out'])
                                ->get()
                            ->get()
                        ->get()
                    ->get()
                ->get()
            ->show();
        return $this;
    }

    public function createSecondaryNavBar(array $navList):HTMLBuilder
    {
        $i=0;
        $navComList=[];
        foreach ($navList as $nav) {
            
            if ($i==0) {
                $this->elementBuilder
                    ->createElement('a', ['class'=>"nav-item nav-link active hvrcenter", 'data-toggle'=>"tab", 'href'=>'#'.str_replace(' ','',$nav)],[$nav]);
            } else {
                $this->elementBuilder
                    ->createElement('a', ['class'=>"nav-item nav-link hvrcenter", 'data-toggle'=>"tab", 'href'=>'#'.str_replace(' ','',$nav)],[$nav]);
            }
            
            $navCom=$this->elementBuilder->getElement();
            array_push($navComList,$navCom);
            $i++;
        }
        $this->compositeBuilder
            ->createComposite('div',['class'=>'secondary-nav-bar'])
            ->composite()
                ->createComposite('nav',['class'=>'pt-3 mb-3'])
                ->composite()
                    ->createComposite('div',['class'=>'nav nav-pills justify-content-start ml-5'])
                    ->addArrayToContent($navComList)
                    ->get()
                ->get()
            ->show();
        return $this;
    }

    public function myRequests(array $requests,string $state='Pending'): HTMLBuilder
    {
        $inputButton = $this->elementBuilder
            ->createElement('input', ['type' => 'button', 'value' => 'New Request', 'class' => "btn btn-primary rounded shadow p-3 mb-4", "id" => "request-vehicle-button"])
            ->getElement();
        $heading = $this->elementBuilder
            ->createElement('h4', [], ['Your ' . $state . ' Requests'])
            ->getElement();
        $i = 0;
        $requestElements = [];
        $cardBuilder = new CardBuilder();
        foreach ($requests as $request) {
            $requestElement= $this->compositeBuilder
                ->createComposite('div',['class' => 'card request-card','id'=> strtolower($state) . 'RequestCard-'.htmlentities($request->getField('requestID')),'style'=>'z-index:2;'])
                ->composite()
                    ->createComposite('div',['class'=>'description'])
                    ->addElement('span',['class'=>'request-id','id'=> strtolower($state) . '-request-' . $i],['Requset id: ' . htmlentities($request->getField('requestID'))])
                    ->addElement('h1',['class'=>'card-title'],['For: ' . htmlentities($request->getField('purpose'))])
                    ->addElement('h1',['class'=>'card-title'],['Status: ' . htmlentities($request->getField('state'))])
                    ->addElement('hr')
                    ->composite()
                        ->createComposite('div',['class'=>'row justify-content-between'])
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['On: ' . htmlentities($request->getField('dateOfTrip'))])
                            ->get() 
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['At: ' . htmlentities($request->getField('timeOfTrip'))])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['From: ' . htmlentities($request->getField('pickLocation'))])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['To: ' . htmlentities($request->getField('dropLocation'))])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col'])
                            ->addElement('p',['class'=>'more'], [])
                            ->get()
                        ->get()
                    ->get()
                ->show();
            array_push($requestElements,$requestElement);
            $i++;
        }
        return $this;
    }

    public function awaitingRequests(array $requests): HTMLBuilder
    {
        $heading = ElementBuilder::getInstance()
            ->createElement('h4', [], ['Your Pending Requests'])
            ->getElement();
        $i = 0;
        $requestElements = [];
        $cardBuilder = new CardBuilder();
        foreach ($requests as $request) {
            $requestElement= $cardBuilder
                ->createCard(['class' => 'card request-card'])
                ->composite()
                    ->createComposite('div',['class'=>'card-body description'])
                    ->addElement('span',['class'=>'request-id','id'=> 'request-' . $i],['Requset id: ' . $request->getField('requestID')])
                    ->addElement('h1',['class'=>'card-title'],['For: ' . $request->getField('purpose')])
                    ->addElement('h1',['class'=>'card-title'],['Status: ' . $request->getField('state')])
                    ->addElement('hr')
                    ->composite()
                        ->createComposite('div',['class'=>'row justify-content-between'])
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['On: ' . $request->getField('dateOfTrip')])
                            ->get() 
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['At: ' . $request->getField('timeOfTrip')])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['From: ' . $request->getField('pickLocation')])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col-sm-3'])
                            ->addElement('p',[], ['To: ' . $request->getField('dropLocation')])
                            ->get()
                        ->composite()
                            ->createComposite('div',['class'=>'col'])
                            ->addElement('p',['class'=>'more'], [])
                            ->get()
                    ->get()
                ->getComposite();
            array_push($requestElements,$requestElement);
            $i++;
        }
        return $this;
    }
}
