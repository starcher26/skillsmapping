import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ImageResult, ResizeOptions } from 'ng2-imageupload';

import { AlertService, UserService, GroupService, NavbarService } from '../_services/index';
import {Group} from "../_models/group";

@Component({
    moduleId: module.id,
    templateUrl: 'register.component.html'
})

export class RegisterComponent implements OnInit {
    src: string = "";
    model: any = {};
    loading = false;
    private groups: Group[] = [];

    constructor(
        private router: Router,
        private userService: UserService,
        private groupService: GroupService,
        private alertService: AlertService,
        private navbarService: NavbarService) { }

    ngOnInit() {
        this.navbarService.showNavBar(true);
        this.loadAllGroups();
        console.log(this.groups);
    }
    register() {
        this.loading = true;
        this.userService.createUser(this.model)
            .subscribe(
                data => {
                    this.alertService.success('Registration successful', true);
                    this.router.navigate(['/login']);
                },
                error => {
                    this.alertService.error(error);
                    this.loading = false;
                });
    }

    resizeOptions: ResizeOptions = {
        resizeMaxHeight: 128,
        resizeMaxWidth: 128
    };

    selected(imageResult: ImageResult) {
        this.src = imageResult.resized
            && imageResult.resized.dataURL
            || imageResult.dataURL;
    }

    private loadAllGroups() {
        this.groupService.getAllGroups().subscribe(
            response => this.groups = response,
            error => {alert("Can't get any groups.");}
        );
    }
}
