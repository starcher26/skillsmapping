/**
 * Created by Mounir on 19/03/2017.
 */
import {Component, OnInit} from "@angular/core";
import {NavbarService} from "../../_services/index";
@Component({
    selector: "navbar",
    templateUrl: "./topnavbar.component.html"
})

export class TopNavbarComponent  {
    showNavBar: boolean = false;
    private currentUser;

    constructor(private navbarService: NavbarService) {
        this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
        this.navbarService.showNavBarEmitter.subscribe((mode)=>{
            // mode null at first time, so we ignore it
            if (mode !== null) {
                this.showNavBar = mode;
            }
        });

    }


}