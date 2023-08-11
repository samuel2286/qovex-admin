<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Spatie\Permission\Models\Role;

class UserForm extends Form
{
    public function buildForm()
    {

        $this
            ->add('name', 'text',[
                'rules' => 'required|min:5|max:200',
                'error_messages' => [
                    'name.required' => 'The name field is mandatory.'
                ],
                'attr' =>[
                    'placeholder' => "Enter user Fullname"
                ]
            ])
            ->add('username', 'text',[
                'rules' => 'required|min:3|max:200',
                'error_messages' => [
                    'username.required' => 'The username field is mandatory.'
                ],
                'attr' =>[
                    'placeholder' => "Enter username"
                ]
            ])
            ->add('phone', 'text',[
                'rules' => 'required|min:3|max:200',
                'error_messages' => [
                    'phone.required' => 'The phone field is mandatory.'
                ],
                'attr' =>[
                    'placeholder' => "Enter phone"
                ]
            ])
            ->add('email', 'email',[
                'rules' => 'required|email',
                'error_messages' => [
                    'email.required' => 'The email field is mandatory.'
                ],
                'attr' =>[
                    'placeholder' => "Enter user Email"
                ]
            ])
            ->add('role', 'select',[
                'attr' => [
                    'class' => 'form-control select2'
                ],
                'choices' => Role::all()->pluck('name','id')->toArray(),
                'empty_value' => '=== Select Role ===',
            ])
            ->add('password', 'password',[
                'error_messages' => [
                    'password.required' => 'The password field is mandatory.'
                ],
                'attr' =>[
                    'placeholder' => "Enter user password"
                ]
            ])
            ->add('password_confirmation', 'password',[
                'attr' =>[
                    'placeholder' => "Repeat password"
                ]
            ])
            ->add('avatar', 'file',[
                'rules' => 'nullable|file|image|mimes:jpg,jpeg,png,gif'
            ])
            ->add('submit','submit',[
                'attr' =>[
                    'class'=> 'btn btn-primary btn-block',
                ]
            ]);
    }
}
