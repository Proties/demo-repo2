"strict"
class Gallery{
	constructor(){
		this._imageList=[];
		this._imageSize=0;
		this._currentImage;
		this._bigCont;
		this._currentItem={
				html:'',
				index:0

				};

	}
	set currentItem(data){
		this._currentItem.html=data.html;
		this._currentItem.index=data.index;
	}
	get currentItem(){
		return this._currentItem;
	}
	set bigCont(s){
		this._bigCont=s;
	}
	get bigCont(){
		return this._bigCont;
	}
	set imageList(s){
		this._imageList=s;
	}
	set currentImage(a){
		this._currentImage=a;
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

	


	eventHandling(){
		const arr=[];
	

		let startx=0.0;
		let starty=0.0;
		const swipeThreshold=50;
		const swipeTime=500;
		let startTime;
		let endx=0.0;
		let endy=0.0;
		
		arr.push(this.bigCont.getElementsByClassName('Primary-post')[0]);
		arr.push(this.bigCont.getElementsByClassName('Secondary-post')[0]);
		arr.push(this.bigCont.getElementsByClassName('Tertiary-post')[0]);

		
		let placeholder=[];
		for(let ar=0;ar<arr.length;ar++){
			if(arr[ar]!==undefined){
				placeholder.push(arr[ar]);
			}
		}
		this.imageList=placeholder;
		this.currentItem.html=arr[arr.length];
		this.currentItem.index=placeholder.length-1;
		this.bigCont.getElementsByClassName('Primary-post')[0].addEventListener('touchstart',function(evt){
			console.log('====touch strat====');
		
			startx=evt.touches[0].clientX;
			starty=evt.touches[0].clientY;
			startTime=new Date().getTime();

		});
		if(this.bigCont.getElementsByClassName('Secondary-post')[0]!==undefined){
			this.bigCont.getElementsByClassName('Secondary-post')[0].addEventListener('touchstart',function(evt){
				console.log('====touch strat====');
	
				startx=evt.touches[0].clientX;
				starty=evt.touches[0].clientY;
				startTime=new Date().getTime();
			});
		}
		if(this.bigCont.getElementsByClassName('Tertiary-post')[0]!==undefined){
			this.bigCont.getElementsByClassName('Tertiary-post')[0].addEventListener('touchstart',function(evt){
				console.log('====touch strat====');
			
			startx=evt.touches[0].clientX;
			starty=evt.touches[0].clientY;
			startTime=new Date().getTime();
			});
		}
		

		this.bigCont.getElementsByClassName('Primary-post')[0].addEventListener('touchend',(evt)=>{
			console.log('touch ====end');
			endx=evt.changedTouches[0].clientX;
			endy=evt.changedTouches[0].clientY;

			const distanceX=Math.abs(endx-startx);
			const distanceY=Math.abs(endy-starty);

			const endTime=new Date().getTime();
			const deltaTime=endTime-startTime;
			const deltaX=endx-startx;
			const deltaY=endy-starty;

			console.log(distanceX);
			if(deltaTime<swipeTime && Math.abs(deltaX)>Math.abs(deltaY) ){
				if(deltaX>swipeThreshold){
					console.log('right swipe');
					this.swipe_right();
				}else if(deltaX< swipeThreshold){
					this.swipe_left();
					console.log('left swipe');
				}else{

				}
				
			}
		});
		if(this.bigCont.getElementsByClassName('Secondary-post')[0]!==undefined){
		this.bigCont.getElementsByClassName('Secondary-post')[0].addEventListener('touchend',(evt)=>{
			console.log('touch ====end');
			endx=evt.changedTouches[0].clientX;
			endy=evt.changedTouches[0].clientY;

			const distanceX=Math.abs(endx-startx);
			const distanceY=Math.abs(endy-starty);

			
			const endTime=new Date().getTime();
			const deltaTime=endTime-startTime;
			const deltaX=endx-startx;
			const deltaY=endy-starty;

			console.log(distanceX);
			if(deltaTime<swipeTime && Math.abs(deltaX)>Math.abs(deltaY) ){
				if(deltaX>swipeThreshold){
					console.log('right swipe');
					this.swipe_right();
				}else if(deltaX< swipeThreshold){
					console.log('left swipe');
					this.swipe_left();
				}else{

				}
				
			}
		});
	}
		if(this.bigCont.getElementsByClassName('Tertiary-post')[0]!==undefined){
		this.bigCont.getElementsByClassName('Tertiary-post')[0].addEventListener('touchend',(evt)=>{
			console.log('touch ====end');
			endx=evt.changedTouches[0].clientX;
			endy=evt.changedTouches[0].clientY;

			const distanceX=Math.abs(endx-startx);
			const distanceY=Math.abs(endy-starty);

			
			const endTime=new Date().getTime();
			const deltaTime=endTime-startTime;
			const deltaX=endx-startx;
			const deltaY=endy-starty;

			console.log(distanceX);
			if(deltaTime<swipeTime && Math.abs(deltaX)>Math.abs(deltaY) ){
				if(deltaX>swipeThreshold){
					alert('==== right swipe');
					this.swipe_right();
				}else if(deltaX< swipeThreshold){
					alert('==== left swipe');
					this.swipe_left();
				}else{

				}
				
			}
		});
	}

	
	}
//this code will be triggerd when the threshold of a left swipe is met
// this code will rearrange the order or the images in a reveres order
//the current image will be moved to the left and the image after it will be moved to its place

swipe_left(){
		const imageList = this.imageList;
		let i=0;
		let nextIndex;
		let currentIndex = this.currentItem.index;
		let maxIndex=imageList.length;
		if(currentIndex==maxIndex){
			nextIndex=currentIndex-1;
		}else{
			nextIndex = currentIndex + 1;
		}

	    

	    // Swap current and next images
	    console.log('====== next image index====');
	    console.log(nextIndex);
	    let currentImage = imageList[currentIndex];
	    const nextImage = imageList[nextIndex];
	 
	    // Animate swap
	    currentImage.style.transition = 'transform 0.5s ease-in-out';
	    nextImage.style.transition = 'transform 0.5s ease-in-out';

	    currentImage.style.transform = 'translateX(-100%)'; // move current image out of view
	    nextImage.style.transform = 'translateX(0)'; // bring next image into view

	    // Update current index after animation completes
	    setTimeout(() => {
	    	currentImage.style.transition = 'transform 0.5s ease-in-out';
	    	nextImage.style.transition = 'transform 0.5s ease-in-out';

	    	currentImage.style.transform = 'translateX(-100%)'; // move current image out of view
	    	nextImage.style.transform = 'translateX(0)'; // bring next 
	        this.currentItem.index = nextIndex;

	    }, 500);
	
	
		
	}
	//this function will be callded when the thres hold of a right swipe has been met 
	//it will take the current image and put it at the end of the array and take the array befor it
	// and place it at the front
	swipe_right() {
    const imageList = this.imageList;
    let currentIndex = this.currentItem.index;
    let prevIndex;
    if(currentIndex==0){
    	prevIndex =currentIndex+1;
    }else{
    	prevIndex =currentIndex-1;
    }
   	


    // Animate swap
    console.log(currentIndex);
    console.log(this.imageList);

    let currentImage = imageList[currentIndex];

    const prevImage = imageList[prevIndex];

    currentImage.style.transition = 'transform 0.5s ease-in-out';
    prevImage.style.transition = 'transform 0.5s ease-in-out';

    currentImage.style.transform = 'translateX(100%)'; // move current image out of view
    prevImage.style.transform = 'translateX(-50%)'; // bring previous image into view

    // Update current index after animation completes
    setTimeout(() => {
    	prevImage.style.zIndex = 30;
    	currentImage.style.zIndex = 10;
    	currentImage.style.transform = 'translateX(-100%)';
	    prevImage.style.transform = 'translateX(10%)'; 

	    currentImage.style.transform = 'translateY(-10%)'; 
	    prevImage.style.transform = 'translateY(10%)';
	    this.currentItem.index=prevIndex;
        
    }, 500);
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