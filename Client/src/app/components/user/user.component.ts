import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

import { UserModel } from '../../models/user/user.model';
import { UserService } from '../../services/user/user.service';

declare let Pusher: any;

@Component({
    selector: 'app-user',
    templateUrl: './user.component.html',
    styleUrls: ['./user.component.css'],
    providers: [
        UserService
    ]
})
export class UserComponent implements OnInit {

    actionList: any[] = ['create', 'update'];
    actionState: string = 'create';

    userOptions: any = {
        isLoaded: false,
        isError: false
    };
    user: UserModel = new UserModel;
    users: UserModel[];

    error: any = '';
    pusher: any;

    userForm: FormGroup;
    userFormErrors: any = {
        'email': '',
        'password': '',
        'name': ''
    };
    userFormValidationMessages: any = {
        'name': {
            'required': 'Name is required.',
            'minlength': 'Name must be at least 6 characters long.'
        },
        'email': {
            'required': 'Email is required.',
            'pattern': 'Email is not valid email pattern.',
            'minlength': 'Email must be at least 6 characters long.'
        },
        'password': {
            'required': 'Password is required.',
            'minlength': 'Password must be at least 6 characters long.'
        }
    };

    constructor(private userService: UserService, private fb: FormBuilder) {}

    ngOnInit() {
        this.bindUsers();
        this.bindPusher();
        this.bindUserForm();
    }

    bindPusher() {
        this.pusher = new Pusher('6c1680691da7a7ad8cc4', {
            cluster: 'eu',
            encrypted: true
        });

        let channel = this.pusher.subscribe('user');

        channel.bind('user.created', (response) => {
            this.users.push(response.data);
        });

        channel.bind('user.deleted', (response) => {
            let id = response.data.id;
            let filter = this.users.filter((user) => {
                return user.id == id;
            })[0];

            this.users.splice(this.users.indexOf(filter), 1);
        });
    }

    bindUsers() {
        this.error = '';
        this.userService.fetch()
            .subscribe(
                data => {
                    this.userOptions.isLoaded = true;
                    this.userOptions.isError = false;
                    this.mapUserData(data);
                },
                error => {
                    this.userOptions.isLoaded = false;
                    this.userOptions.isError = true;
                    this.error = <any>error;
                }
            );
    }

    bindUserForm() {
        this.userForm = this.fb.group({
            'name': [this.user.name, [
                Validators.required,
                Validators.minLength(6)
            ]],
            'email': [this.user.email, [
                Validators.required,
                Validators.minLength(6),
                Validators.pattern(/^[a-z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-z0-9]([a-z0-9-]*[a-z0-9])?(\.[a-z0-9]([a-z0-9-]*[a-z0-9])?)*$/i)
            ]],
            'password': [this.user.password, [
                Validators.required,
                Validators.minLength(6)
            ]]
        });

        this.userForm.valueChanges
            .subscribe(data => this.onUserFormValueChanged(data));
    }

    onUserFormValueChanged(data?: any) {
        if(!this.userForm) return;

        const form = this.userForm;

        for(const field in this.userFormErrors) {
            this.userFormErrors[field] = '';
            const control = form.get(field);

            if(control && control.dirty && !control.valid) {
                const messages = this.userFormValidationMessages[field];
                for(const key in control.errors) {
                    this.userFormErrors[field] += '<div>' + messages[key] + '</div>';
                }
            }
        }
    }

    mapUserData(users: UserModel[]) {
        this.users = users.map((user) => {
            let date = new Date(user.created_at);
            let format = {
                month: (date.getMonth() + 1).toString().length < 2 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
                date: (date.getDate()).toString().length < 2 ? '0' + (date.getDate()) : (date.getDate()),
                year: (date.getFullYear()).toString()
            };
            user.created_at = format.month + '/' + format.date + '/' + format.year;
            return user;
        });
    }

    doUpdate(user: UserModel) {
        this.actionState = this.actionList[1];
    }

    doDelete(user: UserModel) {
        this.userService.delete(user)
            .subscribe(
                data => {
                    /*let filter = this.users.filter((u) => {
                        return u.id == user.id;
                    })[0];
                    this.users.splice(this.users.indexOf(filter), 1);*/
                },
                error => {
                    this.error = 'Error delete user | press delete once again.';
                }
            )
    }

    doSubmit() {
        switch (this.actionState) {
            case 'create' :
                this.doCreateSubmit();
                break;
            case 'update' :
                this.doUpdateSubmit();
                break;
        }
    }

    doCreateSubmit() {
        this.userService.store(this.user)
            .subscribe(
                data => {
                    this.user = new UserModel;
                    this.userForm.reset();
                },
                error => {
                    this.error = 'Error store user data | Please submit again!';
                }
            );
    }

    doUpdateSubmit() {

        this.actionState = this.actionList[0];
    }

}
