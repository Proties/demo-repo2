"strict"
class Checkout{
	constructor(){
		this._checkoutForm;
	}
	set checkoutForm(s){
		this._checkoutForm=s;
	}
	get checkoutForm(){
		return this._checkoutForm;
	}
	get_form(){
		console.log('====works====');
		try{
			let xml=new XMLHttpRequest();
			xml.open('POST','/checkout');
			xml.onload=function(){
				let form=this.responseText;
		
				console.log('=======form info====');
				const parser = new DOMParser();
			    const doc = parser.parseFromString(form, 'text/html');
				console.log(doc);
				let element=doc.getElementsByTagName('div')[0];
				console.log(element);
				document.body.append(element);
			}
			xml.send();
		}catch(err){
			console.log(err);
		}
		
		
	}
}
let checkout=new Checkout();
checkout.get_form();