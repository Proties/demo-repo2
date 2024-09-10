"strict"
let builderContainer=document.getElementById('builderContainer');
let elementsContainer=document.getElementById('elements');

function load_htmlPage(){}

function EventListener(){
	let text=document.getElementsByClassName('textElement');
	let element=document.getElementsByClassName('elementMov');
	let container=document.getElementsByClassName('containerElement');
	let image=document.getElementsByClassName('imageElement');
	let Background=document.getElementsByClassName('backgroundElement');
	let posts=document.getElementsByClassName('postElement');
	let button=document.getElementsByClassName('buttonElement');
	let dragged;

	let borderTop=document.getElementsByClassName('');
	let borderRight=document.getElementsByClassName('');
	let borderLeft=document.getElementsByClassName('');
	let borderBottom=document.getElementsByClassName('');

	document.addEventListener('click',function(evt){
		
		
			for(let b=0;b<element.length;b++){
				element[b].addEventListener('click',function(evt){
				console.log(element[b].childNodes);
				if(element[b].childNodes.length==7){
					console.log('on focus');
					let input=document.createElement('input');
					input.type='text';
					element[b].append(input);
					console.log(element[b]);
					element[b].focus();
				}

				});
			}
		
		
	})
	
	for(let b=0;b<button.length;b++){
		button[b].addEventListener('dragstart',function(evt){
			dragged=button[b].cloneNode(true);
		});
		button[b].addEventListener('dragend',function(evt){

		});

	}
	text[0].addEventListener('dragstart',function(evt){
		// dragged=text[0];
		dragged=text[0].cloneNode(true);

		console.log('drag start');
	});
	text[0].addEventListener('dragend',function(evt){
		console.log('drag has ended');
	});
	builderContainer.addEventListener('dragover',function(evt){
		evt.preventDefault();
	});
	builderContainer.addEventListener('dragenter',function(evt){
		console.log('drag has entered');
	});
	builderContainer.addEventListener('dragleave',function(evt){
		console.log('drag has leaved');
	});

	builderContainer.addEventListener('drop',function(evt){
		evt.preventDefault();
		
		console.log('dropping element');
		console.log(dragged);
		// if(evt.target.className==''){}
		let txtItem=new Text(dragged);
		console.log(txtItem.cont);

		evt.target.append(txtItem.cont);
		// let ele=dragged.classList;
		// ele.remove('elementName');
		// ele.remove('textElement');
		// ele.add('element');
	})
}
function start(){
	EventListener();
	elementsContainer.append();

}
start();