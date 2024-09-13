"strict"
let builderContainer=document.getElementById('builderContainer');
let elementsContainer=document.getElementById('elements');

//this will be an array of html elements
let boardElements=[{x1:0,x2:0,y1:0,y2:0}];
//this will be the currently selected ui element
let currentElement={};
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
function make_id(element){
	let num=0;
	num=ids.length+1;
	let id;
	switch(element){
		case 'Button':
			id='btn'+num;
			break;
		case 'Text':
			id='txt'+num;
			break;
		case 'Container':
			id='cont'+num;
			break;
		case 'Image':
			id='img'+num;
			break;
	}
	ids.push(id);
	return id;
}
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
		
		
	})
	
	for(let b=0;b<button.length;b++){
		button[b].addEventListener('dragstart',function(evt){
			console.log('buttton drag start');
			dragged=button[b].cloneNode(true);
			currentElement=dragged;

		});
		button[b].addEventListener('dragend',function(evt){

		});

	}
	for(let b=0;b<containers.length;b++){
		containers[b].addEventListener('dragstart',function(evt){
			console.log('buttton drag start');
			dragged=containers[b].cloneNode(true);
			currentElement=dragged;

		});
		containers[b].addEventListener('dragend',function(evt){

		});

	}
	for(let b=0;b<images.length;b++){
		images[b].addEventListener('dragstart',function(evt){
			console.log('buttton drag start');
			dragged=images[b].cloneNode(true);
			currentElement=dragged;

		});
		images[b].addEventListener('dragend',function(evt){

		});

	}
	text[0].addEventListener('dragstart',function(evt){
		// dragged=text[0];
		dragged=text[0].cloneNode(true);
		currentElement=dragged;

		console.log('drag start');
	});
	text[0].addEventListener('dragend',function(evt){
		console.log('drag has ended');
	});
	builderContainer.addEventListener('dragover',function(evt){
		evt.preventDefault();
		// console.log('drag element');
		// console.log(evt.clientX);
		// console.log(evt.clientY);
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
		console.log(typeof draggedLine);

		let elementID;
		switch(dragged.innerHTML){
			case 'Button':
				let btn=new Button();
				elementID=make_id(dragged.innerHTML);
				btn.id=elementID;
				btn.cont_attributes();
				btn.draw_borders();
				btn.make_item();
				boardElements.push(btn);
				evt.target.append(btn.cont);
			break;
			case 'Container':
				let cont=new Container();
				elementID=make_id(dragged.innerHTML);
				cont.id=elementID;
				cont.cont_attributes();
				cont.draw_borders();
				cont.make_item();
				boardElements.push(cont);
				evt.target.append(cont.cont);
			break;
			case 'Text':
				let txtItem=new Text(dragged);
				elementID=make_id(dragged.innerHTML);
				txtItem.id=elementID;

				// txtItem.make_item();
				// txtItem.cont_attributes();
				txtItem.draw_borders();
				txtItem.make_item();
				boardElements.push(txtItem);
				evt.target.append(txtItem.cont);
			break;
			case 'Images':
				let img=new Image();
				elementID=make_id(dragged.innerHTML);
				img.id=elementID;
				img.cont_attributes();
				img.draw_borders();
				boardElements.push(img);
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
			// obj.width=;
		});
		
		}
		for(let br=0;br<borderRight.length;br++){
		borderRight[br].addEventListener('dragstart',function(evt){
			draggedLine=evt.target;
			currentElement=evt.target;

			console.log('parent element is');
			console.log(evt.target.parentNode);

			console.log('border dragging');
		});
		borderRight[br].addEventListener('dragend',function(evt){
			console.log(evt.clientX);
			console.log(evt.clientY);
			let obj=find_object(evt.target.id);
			// obj.width=;
			console.log('border has stopped dragging');
		});
	}
	for(let bl=0;bl<borderLeft.length;bl++){
		borderLeft[bl].addEventListener('dragstart',function(evt){
			draggedLine=evt.target;
			currentElement=evt.target;
			console.log(evt.target);
			console.log('border dragging');
		});
		borderLeft[bl].addEventListener('dragend',function(evt){
			let obj=find_object(evt.target.id);
			// obj.width=;
			console.log('border has stopped dragging');
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
		});
	}
		
	})
}
let board=new BoardUI(document.getElementById('builderContainer'));
let user=new User();
// create a separate layer with a single element to position it freely in the container
document.getElementById('builderContainer').addEventListener('dragover',update);
//this function will be called every time an element is an element is dragged over the board
function update(evt){
	console.log(evt);
	// console.log('list of elements on the board');
	// console.log(boardElements);
	// console.log('current selected element');
	// console.log(currentElement);
	for(let i=0;i<boardElements.length;i++){
		if(boardElements[i].x1==currentElement.x1 && boardElements[i].y1==currentElement.y1){
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