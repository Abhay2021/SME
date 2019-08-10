<!-- SEARCH SUBJECT MATTER EXPERT FRONTEND PAGE -->
<div class="card p-5">
  <form id="smeForm" action="" method="post">
    <div class="row justify-content-center"><h1 class="text-center"><tt>SME ENGINE</tt></h1></div>
    <div class="row">
      <div class="col-md-3"></div>
      
        <!-------------- SEARCH BY EXPERT'S NAME OR SECTOR ------------------>
      <div class="col-md-9" >
        <div class="input-group mb-3 " id="the-basics" >
          <input type="text" name="search" id="search" class="form-control typeahead" placeholder="Enter Expert Name or Sector" aria-label="Recipient's username" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="searchNow">search Now</button>
          </div>
        </div>
        <div class="row ml-2" id="error"></div>
        <input type="hidden" name="data" value="getall">
      </div>
      
    </div>

    <div class="row">
      <div class="col-md-3 col-12">
          
        <div class=" text-center"><h3>Filters</h3></div>
          <!-------------- FILTER : SECTOR ------------------>
          <div class="input-group mb-3 justify-content-center">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Sector</label>
            </div>
            <select name="sector" id="sector" class="custom-select filter">
              <option value="" selected>Choose...</option>
              <?php foreach($ex['sector'] as $sec){ 
                echo "<option value='$sec'>$sec</option>";
              } ?>
            </select>
          </div>
      
           <!-------------- FILTER : Country ------------------>
          <div class="input-group mb-3 justify-content-center">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Country</label>
            </div>
            <select name="country" id="country" class="custom-select filter">
              <option value="" selected>Choose...</option>
              <?php foreach($ex['country'] as $coun){ 
                echo "<option value='$coun'>$coun</option>";
              } ?>
            </select>
           </div>
        
           <!-------------- FILTER : Availability ------------------>
          <div class="input-group mb-3 justify-content-center">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Availability</label>
            </div>
            <select name="availability" id="availability" class="custom-select filter">
              <option value="" selected>Choose...</option>
              <option value="1">On Call</option>
              <option value="2">In-Person</option>
            </select>
          </div>

          <!-------------- FILTER : Industry/Academia ------------------>
          <div class="input-group mb-3 justify-content-center">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Industry/Academia</label>
            </div>
            <select name="industry_academia" id="industry_academia" class="custom-select filter">
              <option value="" selected>Choose...</option>
              <option value="1">Industry</option>
              <option value="2">Academia</option>
            </select>
          </div>
          <div>
            <button type="button" class="btn btn-primary" id="smeFormReset">Reset</button>
          </div>
        </div>

        <div class="col-md-9 col-12">
          <div class=" text-center"><h3>Subject Matter Experts</h3></div>
          <div class="tableFixHead">
            <table class="table table-striped table-bordered">
            <col width="80">
            <thead>
              <tr>
                <th >ID <i class="fa fa-sort" aria-hidden="true"></i></th>
                <th>Name <i class="fa fa-sort" aria-hidden="true"></i></th>
                <th>Sector <i class="fa fa-sort" aria-hidden="true"></i></th>
                <th>Industry/Academia <i class="fa fa-sort" aria-hidden="true"></i></th>
                <th>Availability <i class="fa fa-sort" aria-hidden="true"></i></th>
                <th>Country <i class="fa fa-sort" aria-hidden="true"></i></th>
                <th>Request for Quote</th>
              </tr>
              </thead>
              <tbody id="expert_table_body">
              <?php 
                if($ex['experts']['data']){
                  foreach($ex['experts']['data'] as $exp){ 
                    echo "<tr>";
                    echo "<td>".$exp['id']."</td>";
                    echo "<td>".$exp['name']."</td>";
                    echo "<td>".$exp['sector']."</td>";
                    if($exp['industry_academia']==1)
                    {echo "<td>Industry</td>";}
                    else
                    {echo "<td>Academia</td>";}
                    if($exp['availability']==1)
                    {echo "<td>On Call</td>";}
                    else
                    {echo "<td>In-Person</td>";}
                    echo "<td>".$exp['country']."</td>";
                    //A button for trigger popup : request for quote form
                    echo "<td><div class='text-center'> <button  class='btn btn-outline-dark request'  eid='".$exp['id']."' expert='".$exp['name']."'>Request</button></div></td>";
                    echo "</tr>";
                  }
                }
              ?>  
              </tbody>
            </table>
          </div>
          <div class="row mt-3">
            <div class="col-md-6">
              <?php $start = $ex['experts']['start']; 
                    $end= $start + $ex['experts']['result_count']-1;
                    $total = $ex['experts']['total'];
                echo "showing results : <span id='start'>".$start."</span> to <span id='end'>".$end."</span> out of <span id='total'>".$total."</span>"; ?> 
            </div>
            <div class="col-md-6 text-right">
            <input type="hidden" name="limit" value="" id="limit">
              <button type="button"  id="loadmore" class="btn btn-dark mr-5" limit="<?php echo $end; ?>">Load More</button>
            </div>
          </div>
        </div>
      
    </div>
  </form>
</div>
<div>


<!-- A Popup : used to fill form for Quote Request -->
<div class="modal fade" id="requestForm" style="display: none;" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form id="requestQuoteForm" action="" >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Request for Quote : <span id="expertName"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
            <input type="hidden" value="" name="id" id="eid">
            <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Your Name</label>
                <div class="col-sm-10">
                  <input type="text"  class="req form-control" name="name" value="" placeholder="" id="cname">
                  <span class="error"></span>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Email ID</label>
                <div class="col-sm-10">
                  <input type="email" class="req form-control" name="email" value="" placeholder="" id="email">
                  <span class="error"></span>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Project Details</label>
                <div class="col-sm-10">
                  <textarea  class="req form-control" id="detail" name="detail" value=""></textarea>
                  <span class="error"></span>
                </div>
              </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="submitRequest" class="btn btn-primary">Submit Request</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<?php $suggest = array_merge($ex['name'], $ex['sector']); ?>
<script src="<?php echo base_url('assets/typeahead.js') ?>"></script>
<script src="<?php //echo base_url('assets/myjs.js') ?>"></script>
<script>
/*CUSTOM JS FOR SUBJECT MATTER EXPERT FRONTEND PAGE */
/**************Sorting Table column wise START************************ */
$(document).ready(function () {
                $('th').each(function (col) {
                    $(this).hover(
                            function () {
                                $(this).addClass('focus');
                            },
                            function () {
                                $(this).removeClass('focus');
                            }
                    );
                    $(this).click(function () {
                        if ($(this).is('.asc')) {
                            $(this).removeClass('asc');
                            $(this).addClass('desc selected');
                            sortOrder = -1;
                        } else {
                            $(this).addClass('asc selected');
                            $(this).removeClass('desc');
                            sortOrder = 1;
                        }
                        $(this).siblings().removeClass('asc selected');
                        $(this).siblings().removeClass('desc selected');
                        var arrData = $('table').find('tbody >tr:has(td)').get();
                        arrData.sort(function (a, b) {
                            var val1 = $(a).children('td').eq(col).text().toUpperCase();
                            var val2 = $(b).children('td').eq(col).text().toUpperCase();
                            if ($.isNumeric(val1) && $.isNumeric(val2))
                                return sortOrder == 1 ? val1 - val2 : val2 - val1;
                            else
                                return (val1 < val2) ? -sortOrder : (val1 > val2) ? sortOrder : 0;
                        });
                        $.each(arrData, function (index, row) {
                            $('tbody').append(row);
                        });
                    });
                });
            });
/**************Sorting Table column wise END************************ */

/************ Auto suggest for expert's name and sector START ************/



var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
      var matches, substringRegex;
       // an array that will be populated with substring matches
          matches = [];
       // regex used to determine if a string contains the substring `q`
         substrRegex = new RegExp(q, 'i');
      // iterate through the pool of strings and for any string that
      // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
                    matches.push(str);
                  }
                });
                cb(matches);
              };
            };
            var search = <?php echo json_encode($suggest); ?>;
            $('#the-basics .typeahead').typeahead({
              hint: true,
              highlight: true,
              minLength: 1
            },
            {
              name: 'search',
              source: substringMatcher(search)
 });  
/************ Auto suggest for expert's name and sector END ************/
 /******************** get all data on form reset START ***************/
$('#smeFormReset').on('click', function() {
  $('#smeForm').trigger("reset");
       searchExperts();
    }); 
/******************** get all data on form reset END ***************/    
/***************** AJAX call for search and filter vaia API START******/
function searchExperts()
{
  var formdata = $('#smeForm').serialize();
  console.log(formdata);
  var api_url = '<?php echo urlencode(base_url("search_experts")); ?>';
  $.ajax({
          type:'POST',
          url:'<?php echo base_url("searchExperts/connect_api?urlapi="); ?>'+api_url,
          data:formdata,
          dataType:'JSON',
          success:function(data){
            console.log(data);
           
            var table = "";
            if(data.data.length){ //exp means expert
              $.each(data.data , function(key, exp){
                    table += "<tr>";
                    table += "<td>"+exp.id+"</td>";
                    table += "<td>"+exp.name+"</td>";
                    table += "<td>"+exp.sector+"</td>";
                    if(exp.industry_academia==1)
                    {table += "<td>Industry</td>";}
                    else
                    {table += "<td>Academia</td>";}
                    if(exp.availability==1)
                    {table += "<td>On Call</td>";}
                    else
                    {table += "<td>In-Person</td>";}
                    table += "<td>"+exp.country+"</td>";
                    table += "<td><div class='text-center'> <button  class='btn btn-outline-dark request'  eid='"+exp.id+"' expert='"+exp.name+"'>Request</button></div></td>";
                    table += "</tr>";
              });
              var start = data.start-0;
              var end = start + data.result_count-0 -1;
              var total = data.total;
              
              $('#end').html(end);
              $('#total').html(total);
              $('#loadmore').attr('limit',end)
              if($('#limit').val().trim()!=''){
                $('#expert_table_body').append(table);
                $('#limit').val('');
                if(end>=total){
                $('#loadmore').hide();
                $('#limit').val('');
                return false;
                }else{
                  $('#loadmore').show();
                }
              }else{
                $('#expert_table_body').html(table);
                $('#limit').val('');
              }

            }else{  console.log("length ="+data.data.length);
            var msg =  "<tr><td colspan='7' align='center' color='blue'>There are no results that match your search</td></tr>";
              $('#expert_table_body').html(msg);
            }
          }
  });
}
/***************** AJAX call for search and filter vaia API END******/
/* On click Search Now button call searchExperts function for api call  */
$('#searchNow').on('click',function(e){
  e.preventDefault();
  if($('#search').val().trim()==''){
    $('#error').html('Search word is missing !').css('color','red').fadeOut(9500);
  }else{
    searchExperts();
  }
});

/* On select/change any filter call searchExperts function for api call  */
$('.filter').on('change',function(e){
  if($(this).val().trim()!=''){
    searchExperts();
  }
});

/* On click load more button any filter call searchExperts function for api call  */
$('#loadmore').on('click',function(e){
  var limit = $(this).attr('limit');
  if(limit){
    $('#limit').val(limit);
    searchExperts();
  }
});

/******************Request Form Popup START ********************/

$(document).on('click','.request',function(e){
  e.preventDefault();
var eid = $(this).attr('eid'); //Expert id
var expertName = $(this).attr('expert');
$('#eid').val(eid);
$('#expertName').html(expertName);
$("#requestForm").modal("show");
})
/******************Request Form Popup END ********************/
/******************Check Email validation START ********************/
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
/******************Check Email validation END ********************/
/******************Submit Quote request START ********************/
$(document).ready(function () {	
	 $("#submitRequest").on("click", function(e) {
			e.preventDefault();
		var status=true;		
		
		$('.req').each(function(){
		
				if($(this).val().trim()=='')
				{
					$(this).addClass('fieldisrequired');
					$(this).siblings('.error').html('This field is required').show().fadeOut(9500).css("color", "red");
					status=false;
					return false;
				}
				else
				{
					$(this).removeClass('fieldisrequired');
					$(this).siblings('.error').html('');	
			  }

        if($(this).attr('id').trim()=='email'){
            var email = $(this).val().trim();
            if (!validateEmail(email)) 
            {
              $(this).siblings('.error').html('Please enter valid email').show().fadeOut(9500).css("color", "red");
              status=false;
					    return false;
            }
          }
			
		});
        if(!status)
        {
           return status;
        }
        else
        {  	requestformdata = $('#requestQuoteForm').serialize();
           console.log(requestformdata);
           var api_url = '<?php echo urlencode(base_url("submitQuote")); ?>';
          $.ajax({
          type:'POST',
          url:'<?php echo base_url("searchExperts/connect_api?urlapi="); ?>'+api_url,
          data:requestformdata,
          dataType:'JSON',
          success:function(data){
            if(data){ console.log(data);
              alert(data);
              $('#requestQuoteForm').trigger("reset");
              $('#requestForm').modal('toggle');
            }
          }});
        }
		});
  });
/******************Submit Quote request END ********************/
$(function(){
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
});

</script>