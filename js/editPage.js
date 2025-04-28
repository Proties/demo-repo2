"strict"
import TemplateUI from './template.js';
import {MyProfile} from './profile.js';
import Container from './container.js';
import User from './user.js';
import Text from './text.js';
import Button from './button.js';
import List from './list.js';
import Images from './image.js';

let builderContainer=document.getElementById('builderContainer');
let elementsContainer=document.getElementById('elements');

let mainTemplate=new TemplateUI();
let dropDragContainer=mainTemplate.cont;

//this will be an array of html elements
let boardElements=[];
//this will be the currently selected ui element
let currentElement;
let currentElementObj={};
//this variable will be defined be dragstart
let startPos;
//this variable will be defined by drag end
let endPos;
let ids=[];
function load_htmlPage(){}
function find_object(id){
	for(let be=0;be<boardElements.length;be++){
		if(boardElements[be].id==id){
			return boardElements[be];
		}
	}
}


function* make_id(element){
	let num=0;
	while(true){
		yield num++;
	}
}
const idGen=make_id();
function create_cookie(){}
function get_cookie(name){

}
function EventListener(){
	let text=document.getElementsByClassName('textElement');
	let element=document.getElementsByClassName('elementMov');
	let containers=document.getElementsByClassName('containerElement');
	let images=document.getElementsByClassName('imageElement');
	let Background=document.getElementsByClassName('backgroundElement');
	let posts=document.getElementsByClassName('postElement');
	let button=document.getElementsByClassName('buttonElement');
	let dragged;

	let draggedLine;
	let borderTop=document.getElementsByClassName('topLine');
	let borderRight=document.getElementsByClassName('rightLine');
	let borderLeft=document.getElementsByClassName('leftLine');
	let borderBottom=document.getElementsByClassName('bottomLine');
	let containerElements=[];

	text[0].addEventListener('dragstart',function(evt){
		// dragged=text[0];
		let placeholder=document.createElement('span');
		let placeholderTxt=document.createTextNode('Text');
		
		placeholder.append(placeholderTxt);
		dragged=placeholder;
		currentElement=dragged;
		console.log(evt.target.clientX);
		console.log(evt.target.clientY);
		console.log('drag start');
	});

	text[0].addEventListener('dragend',function(evt){
		console.log('drag has ended');
	});
	button[0].addEventListener('dragstart',function(evt){
			console.log('buttton drag start');
			let placeholder=document.createElement('span');
			let placeholderTxt=document.createTextNode('Button');
			
			placeholder.append(placeholderTxt);
			dragged=placeholder;
			currentElement=dragged;
		});
		button[0].addEventListener('dragend',function(evt){
		});

		containers[0].addEventListener('dragstart',function(evt){
			console.log('buttton drag start');
			let placeholder=document.createElement('span');
			let placeholderTxt=document.createTextNode('Container');
			dragged=placeholder;
			placeholder.append(placeholderTxt);
			currentElement=dragged;

		});
		containers[0].addEventListener('dragend',function(evt){

		});


		images[0].addEventListener('dragstart',function(evt){
			console.log('buttton drag start');
			
			let placeholder=document.createElement('span');
			let placeholderTxt=document.createTextNode('Images');
			placeholder.append(placeholderTxt);
			dragged=placeholder;
			currentElement=placeholder;

		});
		images[0].addEventListener('dragend',function(evt){

		});

	builderContainer.addEventListener('dragenter',function(evt){
		console.log('drag has entered');
	});
	builderContainer.addEventListener('dragleave',function(evt){
		console.log('drag has leaved');
	});

	builderContainer.addEventListener('dragover',function(evt){
		evt.preventDefault();
		currentElement.x1=evt.clientX;
		currentElement.y1=evt.clientY;
		
	});
	

	builderContainer.addEventListener('drop',function(evt){
		if(dragged.className=='elementMov'){
			console.log('drag element inside builder');
			return;
		}
		evt.preventDefault();
		let elementID;
		switch(dragged.innerHTML){
			case 'Button':
				let btn=new Button();
				elementID='btn'+idGen.next().value;
				btn.id=elementID;
				btn.cont_attributes();
				btn.draw_borders();
				btn.make_item();
				currentElementObj=btn;
				boardElements.push(btn);
				evt.target.append(btn.cont);
			break;
			case 'Container':
	
				let cont=new Container();
				elementID='cont'+idGen.next().value;
				cont.id=elementID;
				cont.cont_attributes();
				cont.draw_borders();
				cont.make_item();
				currentElementObj=cont;
				boardElements.push(cont);
				evt.target.append(cont.cont);
			break;
			case 'Text':
				let txtItem=new Text();
				elementID='txt'+idGen.next().value;
				txtItem.id=elementID;

				// txtItem.make_item();
				// txtItem.cont_attributes();
				txtItem.draw_borders();
				txtItem.make_item();
				currentElementObj=txtItem;
				boardElements.push(txtItem);
				evt.target.append(txtItem.cont);
			break;
			case 'Images':
				let img=new Image();
				elementID='img'+idGen.next().value;
				img.id=elementID;
				img.cont_attributes();
				img.draw_borders();
				boardElements.push(img);
				currentElementObj=img;
				evt.target.append(img.cont);
			break;
			default:
				console.log('do nothinf');
				break;
		}
		for(let bt=0;bt<borderTop.length;bt++){
		borderTop[bt].addEventListener('dragstart',function(evt){
			currentElement=evt.target;
			dragged=evt.target;
			console.log(evt.target);
			console.log('border dragging');
		});
		borderTop[bt].addEventListener('dragend',function(evt){
			console.log(evt.clientX);
			console.log(evt.clientY);
			let obj=find_object(evt.target.id);
			dragged=evt.target;
			// obj.width=;
		});
		
		}
		for(let br=0;br<borderRight.length;br++){
		borderRight[br].addEventListener('dragstart',function(evt){
			dragged=evt.target;
			currentElement=evt.target;

			console.log('parent element is');
			console.log(evt.target.parentNode);

			console.log('border dragging');
		});
		borderRight[br].addEventListener('dragend',function(evt){
			console.log(evt.clientX);
			console.log(evt.clientY);
			dragged=evt.target;
			let obj=find_object(evt.target.id);
			// obj.width=;
			console.log('border has stopped dragging');
		});
	}
	for(let bl=0;bl<borderLeft.length;bl++){
		borderLeft[bl].addEventListener('dragstart',function(evt){
			draggedLine=evt.target;
			currentElement=evt.target;
			console.log(evt.target.clientX);
			console.log(evt.target.clientY);
			console.log('border dragging');
		});
		borderLeft[bl].addEventListener('dragend',function(evt){
			let obj=find_object(evt.target.id);
			// obj.width=;
			console.log('border has stopped dragging');
			dragged=evt.target;
		});
	}
	for(let bb=0;bb<borderBottom.length;bb++){
		borderBottom[bb].addEventListener('dragstart',function(evt){
			draggedLine=evt.target;
			currentElement=evt.target;
			console.log(evt.target);

			console.log('border dragging');
		});
		borderBottom[bb].addEventListener('dragend',function(evt){
			let obj=find_object(evt.target.id);
			updateBorders(evt);
			console.log('border has stopped dragging');
			dragged=evt.target;
		});
	}
		
	});
	
	for(let e=0;e<element.length;e++){
		element[e].addEventListener('dragstart',function(evt){
			console.log('dragging new element');
			dragged=evt.target;
		});
		element[e].addEventListener('dragend',function(evt){
			dragged=evt.target;
		});
	}
	document.addEventListener('click',function(evt){
			for(let b=0;b<element.length;b++){
				element[b].addEventListener('click',function(evt){
				console.log(element[b].childNodes);
				if(element[b].childNodes.length==7){
					let ele=element[b].getElementsByClassName('elementText');
					console.log('on focus');
					let input=document.createElement('input');
					input.type='text';
					input.value=ele[0].textContent;
					console.log(ele[0].textContent);
					ele[0].style.display='none';
					element[b].append(input);
					console.log(element[b]);
					element[b].focus();
				}
				});
				element[b].addEventListener('focusout',function(evt){
					console.log('focusout');
				});
			}
	});
	
	
	
	
	
}
// let board=new BoardUI(document.getElementById('builderContainer'));
let user=new User();
// create a separate layer with a single element to position it freely in the container
document.getElementById('builderContainer').addEventListener('dragover',update);
//this function will be called every time an element is an element is dragged over the board
function update(evt){
	// containerHolder;
	
	// console.log(currentElement.parentNode);
	// console.log(evt);
	// console.log('list of elements on the board');
	// console.log(boardElements);
	// console.log('current selected element');
	// console.log(currentElement);

	// move old element down
	for(let i=0;i<boardElements.length;i++){
		// console.log(boardElements[i]);
		boardElements[i].get_coords();
		if(boardElements[i].y1>=currentElementObj.y1){
			// builderContainer.insertBefore(currentElementObj.cont,boardElements[i].cont);
			// console.log("move it down");
			boardElements[i].top=currentElementObj.y2;
			boardElements[i].position='absolute';
			// console.log(boardElements[i]);
		// console.log(boardElements);
		// console.log('updated');
	}
	}
	
}
function updateBorders(evt){
	let parentEle=evt.target.parentNode;
	let currentBorder=evt.target;
	let obj=find_object(parentEle.id);

	
	console.log('obejct ====');
	console.log(obj);
	
}
EventListener();