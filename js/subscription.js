"strict"
class Subscription{
	constructor(){
		this._id;
		this._start_date;
		this._end_date;
		this._status;
		this._features={

		}

	}
	set id(s){
		this._id=s;
	}
	set start_date(s){
		this._start_date=s;
	}
	set end_date(s){
		this._end_date=s;
	}
	set status(s){
		this._status=s;
	}

	get id(){
		return this._id;
	}
	get start_date(){
		return this._start_date;
	}
	get end_date(){
		return this._end_date;
	}
	get status(){
		return this._status;
	}
	get features(){
		return this._features;
	}


}
class SubscriptionUI extends Subscription{
	constructor(){
		super();
	}
	registration_form(){}
	pause_subscription(){}
	resume_subscription(){}
	start_subscription(){}
	subscription_info(){
		
	}
}