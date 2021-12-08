<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text',[
                'rules' => 'required|min:2|max:255',
                'error_messages' => [
                    'role.required' => 'The role field is mandatory.'
                ],
                'attr' =>[
                    'placeholder' => "Enter role"
                ]
            ])
            ->add('permission', 'select',[
                'rules' => 'required',
                'choices' => Permission::all()->pluck('name')->toArray(),
                'selected' => function($data){
                    return Permission::all()->pluck('name',$data);
                  
                },
                'attr' =>[
                    'class' => "form-control select2",
                    'multiple' => 'multiple',
                    'data-placeholder'=>"choose permission"
                ]
            ])            
            ->add('submit','submit',[
                'attr' =>[
                    'class'=> 'btn btn-primary btn-block',
                ]
            ]);
    }
}
