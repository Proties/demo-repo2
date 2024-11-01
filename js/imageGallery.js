"strict"
class Gallery{
	constructor(){
		this._imageList=[];
		this._imageSize=0;
		this._currentImage;
		this._bigCont;

	}
	set bigCont(s){
		this._bigCont=s;
	}
	get bigCont(){
		return this._bigCont;
	}
	set currentImage(s){
		this._currentImage=s;
	}
	get currentImage(){
		return this._currentImage;
	}
	get imageList(){
		return this._imageList;
	}
	get imageSize(){
		return this._imageSize;
	}

	add_image(data){
		this.imageList.push(
			{
				id:data.id,
				src:data.src,
				caption:data.caption


			});

	}
	remove_image(){

	}
}
export class MobileGallery extends Gallery{
	constructor(){
		super();
		
	}
	swipe_left(){
		if(distanceX<=40){

			let maxIndex=arr.length;

			if(i<=maxIndex){
				
			
			//move the current image x px to the right
			// change the zIndex of the current image 
			// change the image below to  a higher zIndex
			// all[i].style.display='none';
			
			console.log(arr[i]);
			arr[i].style.transition='transform 0.5s ease-in-out';
			arr[i+1].style.transition='transform 0.5s ease-in-out';
			arr[i].style.transform='translateX(150px)';
			arr[i+1].style.transform='translateX(-100px)';
			

			setTimeout(()=>{
				arr[i].style.zIndex=20;
				arr[i].style.transition='transform 0.5s ease-in-out';
				arr[i+1].style.transition='transform 0.5s ease-in-out';
				arr[i].style.transform='translateX(-40px)';
				arr[i+1].style.transform='translateX(20px)';

				arr[i].style.transform='translateY(-10px)';
				arr[i+1].style.transform='translateY(-1px)';
				i++;
			},500);
				
		}
	}
	}
	swipe_right(){
		console.log('touch ====end');
			endx=evt.changedTouches[0].clientX;
			endy=evt.changedTouches[0].clientY;

			const distanceX=Math.abs(endx-startx);
			const distanceY=Math.abs(endy-starty);

			console.log(distanceX);
			if(distanceX>=40){


				
				let maxIndex=arr.length;

				if(i<=maxIndex){
					
				
				//move the current image x px to the right
				// change the zIndex of the current image 
				// change the image below to  a higher zIndex
				// all[i].style.display='none';
				
				console.log(arr[i]);
				arr[i].style.transition='transform 0.5s ease-in-out';
				arr[i+1].style.transition='transform 0.5s ease-in-out';
				arr[i].style.transform='translateX(-150px)';
				arr[i+1].style.transform='translateX(100px)';
				

				setTimeout(()=>{
					arr[i].style.zIndex=20;
					arr[i].style.transition='transform 0.5s ease-in-out';
					arr[i+1].style.transition='transform 0.5s ease-in-out';
					arr[i].style.transform='translateX(40px)';
					arr[i+1].style.transform='translateX(-20px)';

					arr[i].style.transform='translateY(-10px)';
					arr[i+1].style.transform='translateY(-1px)';
					i++;
				},500);
				
			}

			
		}
	}


	eventHandling(){
		let arr=[];
		let i=0;

		let startx=0.0;
		let starty=0.0;

		let endx=0.0;
		let endy=0.0;

		arr.push(this.bigCont.getElementsByClassName('Primary-post')[0]);
		arr.push(this.bigCont.getElementsByClassName('Secondary-post')[0]);
		arr.push(this.bigCont.getElementsByClassName('Tertiary-post')[0]);

		this.bigCont.getElementsByClassName('Primary-post')[0].addEventListener('touchstart',function(evt){
			startx=evt.touches[0].clientX;
			starty=evt.touches[0].clientY;
		});
		if(this.bigCont.getElementsByClassName('Secondary-post')[0]!==undefined){
			this.bigCont.getElementsByClassName('Secondary-post')[0].addEventListener('touchstart',function(evt){
				startx=evt.touches[0].clientX;
				starty=evt.touches[0].clientY;
			});
		}
		if(this.bigCont.getElementsByClassName('Tertiary-post')[0]!==undefined){
			this.bigCont.getElementsByClassName('Tertiary-post')[0].addEventListener('touchstart',function(evt){
			startx=evt.touches[0].clientX;
			starty=evt.touches[0].clientY;
			});
		}
		

		this.bigCont.getElementsByClassName('Primary-post')[0].addEventListener('touchend',function(evt){
			console.log('touch ====end');
			endx=evt.changedTouches[0].clientX;
			endy=evt.changedTouches[0].clientY;

			const distanceX=Math.abs(endx-startx);
			const distanceY=Math.abs(endy-starty);

			console.log(distanceX);
			if(distanceX >=40){
				this.swipe_right();
			}
			if(distanceX <=40){
				this.swipe_left();
			}
		});
		if(this.bigCont.getElementsByClassName('Secondary-post')[0]!==undefined){
		this.bigCont.getElementsByClassName('Secondary-post')[0].addEventListener('touchend',function(evt){
			console.log('touch ====end');
			endx=evt.changedTouches[0].clientX;
			endy=evt.changedTouches[0].clientY;

			const distanceX=Math.abs(endx-startx);
			const distanceY=Math.abs(endy-starty);

			console.log(distanceX);
			if(distanceX >=40){
				this.swipe_right();
			}
			if(distanceX <=40){
				this.swipe_left();
			}
		});
	}
		if(this.bigCont.getElementsByClassName('Tertiary-post')[0]!==undefined){
		this.bigCont.getElementsByClassName('Tertiary-post')[0].addEventListener('touchend',function(evt){
			console.log('touch ====end');
			endx=evt.changedTouches[0].clientX;
			endy=evt.changedTouches[0].clientY;

			const distanceX=Math.abs(endx-startx);
			const distanceY=Math.abs(endy-starty);

			if(distanceX >=40){
				this.swipe_right();
			}
			if(distanceX <=40){
				this.swipe_left();
			}
		});
	}

	
	}

	

}

export class DesktopGallery extends Gallery{
	constructor(){
		super();
		this._rigthBtn;
		this._leftBtn;

		
	}
	set rigthBtn(s){
		this._rigthBtn=s;
	}
	set leftBtn(s){
		this._leftBtn=s;
	}

	get rigthBtn(){
		return this._rigthBtn;
	}
	get leftBtn(){
		return this._leftBtn;
	}
	create_rightBtn(){
		let btnCont=document.createElement('div');
		let btn=document.createElement('button');
		let btnTxt=document.createTextNode('->');
		btnCont.style.backgroundColor='black';
		btnCont.style.zIndex=50;
		btnCont.style.width='3em';
		// btnCont.style.marginRight='4px';
		btnCont.style.height='3em';
		btn.style.height='100%';
		btn.style.width='100%';
		btnCont.style.position='absolute';
		btnCont.style.top='50%';
		btnCont.style.right=0;

		// btnCont.style.positionRight=0;
	
		btn.append(btnTxt);
		this.rightBtn=btn;
		btnCont.append(btn);
		return btnCont;
		
	}
	create_leftBtn(){
		let leftCont=document.createElement('div');
		let left=document.createElement('button');
		let leftTxt=document.createTextNode('<-');
		leftCont.style.backgroundColor='black';
		leftCont.style.zIndex=51;
		// leftCont.style.marginLeft='-300px';
		leftCont.style.width='3em';
		leftCont.style.height='3em';
		leftCont.style.position='absolute';
		leftCont.style.top='50%';
		leftCont.style.left=0;
		left.style.height='100%';
		left.style.width='100%';
		left.style.positionBottom=0;
		left.append(leftTxt);
		this.leftBtn=left;
		leftCont.append(left);
		return leftCont;

		
	}
	create_gallery(){
		let right=this.create_rightBtn();
		let left=this.create_leftBtn();
		this.bigCont.style.position='relative';
		this.bigCont.append(right);
		this.bigCont.append(left);
		// let container;
		// for(let i=0;i<this.imageSize;i++){
			
		// }
		// this.bigCont.append(container);
	}
	eventHandling(){
		
		let i=0;
		let position=0;
		let mainView;
		let arr=[]
		this.leftBtn.addEventListener('click',function(evt){
			let parentCont=evt.target.parentNode.parentNode;
			arr.push(parentCont.getElementsByClassName('Primary-post'));
			arr.push(parentCont.getElementsByClassName('Secondary-post'));
			
			let all=parentCont.getElementsByClassName('post-image');
			console.log(arr);
			let maxIndex=arr.length;

			if(i==maxIndex){
				i=0;
			}
			
			//move the current image x px to the right
			// change the zIndex of the current image 
			// change the image below to  a higher zIndex
			// all[i].style.display='none';
			
			console.log(arr[i][0]);
			arr[i][0].style.transition='transform 1s ease-in-out';
			arr[i][0].style.transition='transform 1s ease-in-out';
			arr[i][0].style.transform='translateX(-150px)';
			arr[i+1][0].style.transform='translateX(100px)';
			

			setTimeout(()=>{
				arr[i][0].style.zIndex=20;
				arr[i][0].style.transition='transform .5s ease-in-out';
				arr[i][0].style.transition='transform .5s ease-in-out';
				arr[i][0].style.transform='translateX(70px)';
				arr[i+1][0].style.transform='translateX(-50px)';
			},1000);
			i++;

			// all[i-1].style.
			// console.log(all[i-1]);
			console.log(arr[i][0]);
			console.log('=====left button');
		});
		this.rightBtn.addEventListener('click',function(evt){
			let parentCont=evt.target.parentNode.parentNode;
			arr.push(parentCont.getElementsByClassName('Primary-post'));
			arr.push(parentCont.getElementsByClassName('Secondary-post'));
			
			let all=parentCont.getElementsByClassName('post-image');
			console.log(arr);
			// if(i>=all.length){
			// 	i=0;
			// }
			// i++;
			//move the current image x px to the right
			// change the zIndex of the current image 
			// change the image below to  a higher zIndex
			// all[i].style.display='none';
			if(arr[i][0]==undefined){
				return;
			}
			console.log(arr[i][0]);
			arr[i][0].style.transition='transform 1s ease-in-out';
			arr[i+1][0].style.transition='transform 1s ease-in-out';
			arr[i+1][0].style.transform='translateX(150px)';
			arr[i][0].style.transform='translateX(-100px)';
			

			setTimeout(()=>{
				arr[i][0].style.zIndex=20;
				arr[i][0].style.transition='transform .5s ease-in-out';
				arr[i+1][0].style.transition='transform .5s ease-in-out';
				arr[i+1][0].style.transform='translateX(-60px)';
				arr[i][0].style.transform='translateX(50px)';
			},1000);
			

			// all[i-1].style.
			// console.log(all[i-1]);
			console.log(arr[i][0]);
			console.log('=====right button');
		});
	}

}