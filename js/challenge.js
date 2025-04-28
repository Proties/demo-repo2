"strict"
class Challenge{
	constructor(){
		this._id;
		this._name;
		this._location;
		this._description;
		this._startDate;
		this._endDate;
		this._endTime;
		this._startTime;
		this._status;

	}

}

class ChallengeUI extends Challenge{
	constructor(){
		super();
	}
	create_challenge(){}
}