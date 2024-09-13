"strict"
let builderContainer=document.getElementById('builderContainer');
let elementsContainer=document.getElementById('elements');

function load_htmlPage(){}
function find_object(id){

}
function make_id(element){
	let id;
	let num;
	if(element.innerHTML=='Button'){
		id='btn'+num;
	}
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

		
	for(let bt=0;bt<borderTop.length;bt++){
		borderTop[bt].addEventListener('dragstart',function(evt){
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
			console.log(evt.clientX);
			console.log(evt.clientY);

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
			console.log(evt.target);
			console.log('border dragging');
		});
		borderBottom[bb].addEventListener('dragend',function(evt){
			let obj=find_object(evt.target.id);
			// obj.height=;
			console.log('border has stopped dragging');
		});
	}


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

		});
		button[b].addEventListener('dragend',function(evt){

		});

	}
	for(let b=0;b<containers.length;b++){
		containers[b].addEventListener('dragstart',function(evt){
			console.log('buttton drag start');
			dragged=containers[b].cloneNode(true);

		});
		containers[b].addEventListener('dragend',function(evt){

		});

	}
	for(let b=0;b<images.length;b++){
		images[b].addEventListener('dragstart',function(evt){
			console.log('buttton drag start');
			dragged=images[b].cloneNode(true);

		});
		images[b].addEventListener('dragend',function(evt){

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
		if(typeof draggedLine=='object'){


		switch(draggedLine.className){
			case 'rightLine':
				return;
				break;
			case 'topLine':
				return;
				break;
			case 'leftLine':
				return;
				break;
			case 'bottomLine':
				return;
				break;
		}
	}
		switch(dragged.innerHTML){
			case 'Button':
				let btn=new Button();
				btn.draw_borders();
				btn.make_item();
				containerElements.push(btn);
				evt.target.append(btn.cont);
			break;
			case 'Container':
				let cont=new Container();
				cont.draw_borders();
				cont.make_item();
				containerElements.push(cont);
				evt.target.append(cont.cont);
			break;
			case 'Text':
				let txtItem=new Text(dragged);
				// txtItem.make_item();
				txtItem.draw_borders();
				txtItem.make_item();
				containerElements.push(txtItem);
				console.log(txtItem.cont);

				evt.target.append(txtItem.cont);
			break;
			case 'Images':
				let img=new Image();
				img.draw_borders();
				containerElements.push(img);
				evt.target.append(img.cont);
			break;
		}
		
	})
}
function update(){}
function start(){
	let board=new BoardUI(document.getElementById('builderContainer'));
	board.draw_board();
	EventListener();
	elementsContainer.append();

}
start();