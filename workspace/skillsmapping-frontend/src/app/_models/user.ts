/**
 * Created by Mounir on 18/03/2017.
 */
export class User {
    id: number;
    email: string;
    username: string;
    password: string;
    firstName: string;
    lastName: string;
    hiredDate: any;
    image: any;
    groups: any;

    constructor() {
    }
    set humanDate(e){
        e = e.split('-');
        let d = new Date(Date.UTC(e[0], e[1]-1, e[2]));
        this.hiredDate.setFullYear(d.getUTCFullYear(), d.getUTCMonth(), d.getUTCDate());
    }

    get humanDate(){
        return this.hiredDate.toISOString().substring(0, 10);
    }
}
