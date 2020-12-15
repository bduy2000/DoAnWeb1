<?php
    require_once 'init.php';
    //$listproduct = loadlistProduct();
    //$listproduct2 = loadlistProduct();
    $i=0;
    $i2=1;
    $i3=0;
    $title ='Home';
?>
<?php include 'header.php'; ?>
<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <?php  while($listproduct2[$i2]):?>
            <?php echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i2.'"></li>'?>
            <?php $i2=$i2+1;?>
            <?php endwhile; ?>
        
           
      </ol>
      <div class="carousel-inner" role="listbox">
      <?php  while($listproduct2[$i3]):?>
        <?php if($i3 == 0):?>
        <!-- Slide dau la  -->
        <?php echo '<div class="carousel-item active" style="background-image: url(data:image/jpeg;base64,'.base64_encode($listproduct2[$i3]['MainPicture']).')">'?>
        <?php else:?>
        <?php echo '<div class="carousel-item" style="background-image: url(data:image/jpeg;base64,'.base64_encode($listproduct2[$i3]['MainPicture']).')">'?>
        <?php endif;?>  
        <div class="carousel-caption d-none d-md-block">
            <?php echo '<h3 class="text-truncate">'.$listproduct2[$i3]['NameProduct'].'</h3>'?>
          </div>
        </div>
        <?php $i3=$i3+1;?>
            <?php endwhile; ?>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</header>  
</br>
    <div class="container" >
    <div class= "row d-inline-flex">
         <?php  while($listproduct[$i]):?>
            <div class ="col-6 col-sm-4 col-md-3 p-2">
            <div class="card h-100">
                <div>
                <div>
                <svg  width="1em" height="1em"   viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <?php echo '<path id="icon-'.$listproduct[$i].'"d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/> '?>
                </svg>
                </div>
            
                    <?php echo '<img class="card-img-top"  style="object-fit: cover;" src="data:image/jpeg;base64,' . base64_encode($listproduct[$i]['MainPicture']) . '"/>' ?>
                </div>
                <div class="card-title">
                <h2  class="text-truncate" style="font-size:15px ;font-family:Lucida Console" ><?php echo $listproduct[$i]['NameProduct'] ?></h2>
                </div>
                <p class="card-text" style="font-size:15px ;color:#ff0000;" ><?php echo $listproduct[$i]['Price'] ?></p>
            </div>
            </div>
            <?php $i=$i+1;?>
            <?php endwhile; ?>
            <script>
     // first we get all the path elements and put them in an array
			let paths = document.getElementsByTagName('path')

			//now we can loop over the array and add an eventlistener to each path in the array
			// it listens to the 'click' event and then runs function toggleClass()
			for(let j=0; j<paths.length; j++){
				paths[j].addEventListener('click', toggleClass)
			}

			// In the function toggleClass we can toggle the 'clicked' class.
			function toggleClass() {
				this.classList.toggle('clicked')};
			</script>
 </div>
</div>
     

