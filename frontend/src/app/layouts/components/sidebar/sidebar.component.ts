import {Component, OnInit} from '@angular/core';
import {Department} from "../../../model/department.model";
import {ApiService} from "../../../api_service/api.service";

@Component({
    selector: 'app-sidebar',
    templateUrl: './sidebar.component.html',
    styleUrls: ['./sidebar.component.scss']
})
export class SidebarComponent implements OnInit {

    public departments: Department[];
    public loading:boolean;

    constructor(
        private api_service:ApiService
    ){

    }

    ngOnInit(): void {

        this.updateDepartments();

    }

    public updateDepartments(){

            this.loading = true;
        this.api_service.getDepartments().subscribe(
            (departments:Department[])=>{
                this.departments = departments;
                this.loading = false;
            }
        );


    }

    isActive = false;
    showMenu = '';
    eventCalled() {
        this.isActive = !this.isActive;
    }
    addExpandClass(element: any) {
        if (element === this.showMenu) {
            this.showMenu = '0';
        } else {
            this.showMenu = element;
        }
    }
}
