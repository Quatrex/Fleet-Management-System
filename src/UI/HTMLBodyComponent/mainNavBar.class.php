<?php

namespace UI\HTMLBodyComponent;

use Employee\Employee;
use UI\Builder\CompositeBuilder;

class MainNavBar extends HTMLBodyComponent
{
    private Employee $employee;
    private array $navList;
    private CompositeBuilder $compositeBuilder;

    public function __construct(Employee $employee, array $navList = [])
    {
        $this->employee = $employee;
        $this->navList = $navList;
        $this->compositeBuilder = new CompositeBuilder();
    }

    /**
     * @inheritDoc
     */
    public function create():void
    {
        $i = 0;
        $navComList = [];
        foreach ($this->navList as $nav) {

            if ($i == 0) {
                $this->compositeBuilder
                    ->createComposite('li', ['class' => "nav-item hvrcenter active", 'id' => str_replace(' ', '', $nav) . 'MainLink', 'data-toggle' => str_replace(' ', '', $nav)]);
            } else {
                $this->compositeBuilder
                    ->createComposite('li', ['class' => "nav-item hvrcenter mr-2", 'id' => str_replace(' ', '', $nav) . 'MainLink', 'data-toggle' => str_replace(' ', '', $nav)]);
            }

            $navCom = $this->compositeBuilder
                ->addElement('a', ['class' => 'nav-link'], [$nav])
                ->getComposite();
            array_push($navComList, $navCom);
            $i++;
        }
        $this->bodyComponent =
            $this->compositeBuilder
            ->createComposite('nav', ['class' => "main-nav navbar navbar-expand-md d-flex navbar-dark py-0"])
            ->composite()
            ->createComposite('a', ['class' => "navbar-brand mr-auto", 'href' => "#"])
            ->addElement('img', ['src' => "../images/national-logo.png", 'class' => "logo img-fluid"])
            ->get()
            ->composite()
            ->createComposite('div',['class'=>"d-flex flex-nowrap"])
            ->composite()
            ->createComposite('div',['class'=>"order-3  d-md-none"])
            ->composite()
            ->createComposite('button', ['class' => "menu-toggle navbar-toggler", 'id' => 'res-menu-toggler', 'type' => "button", 'style'=>"margin-top: 12px;"])
            ->addElement('span', ['class' => "navbar-toggler-icon"])
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'tab-info order-sm-2 order-md-0  d-sm-none d-md-block', 'id' => "mainnavbarContent"])
            ->composite()
            ->createComposite('ul', ['class' => 'navbar-nav ml-auto', 'id' => 'mainNavBarContainer'])
            ->addArrayToContent($navComList)
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => 'order-sm-1 order-md-1'])
            ->composite()
            ->createComposite('a', ['class' => "nav-link dropdown-toggle", 'id' => "navbarDropdownMenuLink-55", 'data-toggle' => "dropdown", 'aria-haspopup' => "true", 'aria-expanded' => "false"])
            ->addElement('img', ['src' => $this->employee->getField('profilePicturePath') != null ? "../images/profilePictures/" . $this->employee->getField('profilePicturePath') : "../images/default-user-image.png", 'class' => "rounded-circle user-image mt-2  ProfilePicture UserProfilePicture img-fluid", 'style' => "height:35px;"])
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "dropdown-menu dropdown-menu-lg-right dropdown-secondary profile-dropdown mr-3",  'style' => "position:absolute;"])
            ->composite()
            ->createComposite('div', ['class' => "user-dropdown dropdown-content", 'style'=>'text-align:center'])
            ->addElement('img', ['class' => 'ProfilePicture UserProfilePicture img-fluid', 'src' => $this->employee->getField('profilePicturePath') != null ? "../images/profilePictures/" . $this->employee->getField('profilePicturePath') : "../images/default-user-image.png"])
            ->composite()
            ->createComposite('div', ['class' => 'container'])
            // ->addElement('p')
            // ->addElement('p', ['class' => "name-profile-dd"])
            // ->addElement('p', ['class' => "name-profile-dd"])
            // ->addElement('p', ['class' => "mail-profile-dd"])
            // ->addElement('p')
            ->addElement('button', ['type' => "button", 'class' => "btn btn-light mx-auto my-2", 'id' => "UserProfileEditButton",'style'=>"width:80%;height: 2.25rem;"], ['Edit account info'])
            ->get()
            ->get()
            ->composite()
            ->createComposite('div', ['class' => "footer-profile"])
            ->addElement('a', ['type' => "button", 'class' => "btn btn-light", 'href' => "../func/logout.php",'style'=>"height: 2.25rem;"], ['Sign out'])
            ->get()
            ->get()
            ->get()
            ->get()
            ->getComposite();
    }

}
