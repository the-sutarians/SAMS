<?php include 'db_connect.php' ?>
<style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}
.imgs{
		margin: .5em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
		height: 60vh !important;background: black;
	}
	#imagesCarousel .carousel-item.active{
		display: flex !important;
	}
	#imagesCarousel .carousel-item-next{
		display: flex !important;
	}
	#imagesCarousel .carousel-item img{
		margin: auto;
	}
	#imagesCarousel img{
		width: auto!important;
		height: auto!important;
		max-height: calc(100%)!important;
		max-width: calc(100%)!important;
	}
    button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    margin-top: 30px;
}


button.accordion.active,
button.accordion:hover {

    background-color: #ddd;
}


button.accordion:after {

/* Unicode character for "plus" sign
(+) is '\02795' */ 

    content: '\02795';
    font-size: 13px;
    color: #777;
    float: right;
    margin-left: 5px;
}


button.accordion.active:after {

/* Unicode character for "minus" sign
(-) is '\2796' */ 

    content: "\2796";
}


div.panel {
    padding: 0 18px;
    background-color: white;

    max-height: 0;
    overflow: hidden;
    transition: 0.6s ease-in-out;
    opacity: 0;
}

div.panel.show {
    opacity: 1;
    max-height: 500px;
}

</style>

<div class="containe-fluid">
	<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php echo "Welcome back ". $_SESSION['login_name']."!" 

                     ?>

                        <button class="accordion">Attendance
</button>

<div class="panel">
<br/>
<p>
    <img src="img/att1.jpg">
</p>

</div>

<button class="accordion">Student's</button>
<div class="panel">
<br>
<p>It is a common belief that students who attend more classes earn higher final examination marks 
compared to those who always skips classes. In a class that involves calculation, it is important 
for students to be present in class to see the several methods taught by their lecturers to solve 
any questions and tutorial since there are various way of solving any statistical problem. Hence, 
for students who frequently skips class, they will be at a drawback for they had missed several 
materials covered. </p><p>
Students are expected to attend all meetings of the classes in which they are enrolled in. It is a 
common belief that in higher education, attendance is a significant contributor to course grades; 
however, this is not always the case. Some students may learn promptly from being in class and 
listening to lectures, whereas others may only derive little advantage from them.  </p>
<p>
    Students class participation and engagement takes a significant role over today’s higher 
education. The association between students’ class attendance and academic performance had
been the subject of several studies in a wide variety of courses.
</p>

</div>

<button class="accordion">Teacher's
</button>
<div class="panel">
<br/>

<p>
    Across the country, states are holding college's accountable for student absenteeism rates. This puts pressure on teachers to make sure students are showing up for class every day.

Some teachers argue there is little they can do to influence attendance, given the challenges students face beyond the classroom. And it’s true that some students are simply too sick, hungry, or depressed to come to college, while others are so disengaged that they skip class.
</p>

</div>

<script>

var acc = document
.getElementsByClassName("accordion");

var i;

for (i = 0; i < acc.length; i++) {
 acc[i].onclick = function(){
  this.classList.toggle("active");
  this.nextElementSibling.classList
  .toggle("show");
  }
}

</script>

                    <hr>
                </div>
            </div>      			
        </div>
    </div>
</div>
<script>
	$('#manage-records').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                resp=JSON.parse(resp)
                if(resp.status==1){
                    alert_toast("Data successfully saved",'success')
                    setTimeout(function(){
                        location.reload()
                    },800)

                }
                
            }
        })
    })
    $('#tracking_id').on('keypress',function(e){
        if(e.which == 13){
            get_person()
        }
    })
    $('#check').on('click',function(e){
            get_person()
    })
    function get_person(){
            start_load()
        $.ajax({
                url:'ajax.php?action=get_pdetails',
                method:"POST",
                data:{tracking_id : $('#tracking_id').val()},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()

                        }else if(resp.status == 2){
                            alert_toast("Unknow tracking id.",'danger');
                            end_load();
                        }
                    }
                }
            })
    }
</script>