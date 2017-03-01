import { Component, OnInit } from '@angular/core';

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

    user: UserModel = new UserModel;
    users: UserModel[];

    error: any = '';

    pusher: any;

    constructor(private userService: UserService) {
        Pusher.logToConsole = true;

        this.pusher = new Pusher('6c1680691da7a7ad8cc4', {
            cluster: 'eu',
            encrypted: true
        });

        let channel = this.pusher.subscribe('users');
        channel.bind('UserAdded', (data) => {
            console.log(data);
        });
    }

    ngOnInit() {
        this.bindUsers();
    }

    bindUsers() {
        this.userService.fetch()
            .subscribe(
                data => { this.users = data; },
                error => { this.error = <any>error; }
            );
    }

}
