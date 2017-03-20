import { Component, OnInit } from '@angular/core';

import { User } from '../_models/index';
import { UserService, NavbarService } from '../_services/index';

@Component({
    moduleId: module.id,
    templateUrl: 'home.component.html'
})

export class HomeComponent implements OnInit {
    private currentUser;
    private users: User[] = [];

    constructor(private userService: UserService, private navbarService: NavbarService) {
        this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
        this.navbarService.showNavBar(true);
    }

    ngOnInit() {
        console.log(this.currentUser);
        this.loadAllUsers();
    }

    public deleteUser(id: number) {
        this.userService.deleteUser(id).subscribe(() => { this.loadAllUsers() });
    }

    private loadAllUsers() {
        this.userService.getAllUsers().subscribe(
            response => this.users = response,
            error => {alert(`Can't get any users.`);}
        );
    }
}