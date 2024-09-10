"strict"
let builderContainer=document.getElementById('builderContainer');
let elementsContainer=document.getElementById('elements');

function load_htmlPage(){}

function EventListener(){
	let text=document.getElementsByClassName('textElement');
	let element=document.getElementsByClassName('elementMov');
	let containers=document.getElementsByClassName('containerElement');
	let images=document.getElementsByClassName('imageElement');
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
		switch(dragged.innerHTML){
			case 'Button':
				let btn=new Button();
				btn.draw_borders();
				btn.make_item();
				evt.target.append(btn.item);
			break;
			case 'Container':
				let cont=new Container();
				cont.draw_borders();
				evt.target.append(cont.item);
			break;
			case 'Text':
				let txtItem=new Text(dragged);
				// txtItem.make_item();
				txtItem.draw_borders();
				txtItem.make_item();
				console.log(txtItem.cont);

				evt.target.append(txtItem.cont);
			break;
			case 'Images':
				let img=new Image();
				img.draw_borders();
				evt.target.append(img.item);
			break;
		}
		
	})
}
function start(){
	EventListener();
	elementsContainer.append();

}
start();