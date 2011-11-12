<style type="text/css">
input[type="text"], input[type="password"], textarea {
-moz-box-shadow: none;
-webkit-box-shadow: none;
box-shadow: none;
border: none;
}
#approved-table{margin-top: 80px;}
</style>
<div id="VS">
</div>
<div id="search_box_container2">
</script>
<script type="text/javascript">
function see_record(e)
{
alert("Hi!");
}
</script>
<script type="text/javascript">
$j=jQuery.noConflict();
<?php echo "var page_id=$post->ID;" ;?>
function email(e)
{
var id=e.id;
$j.get("wp-content/themes/twentyeleven/mailform.php?page="+page_id+"&email="+id,function(data)
{
$j(data).modal();
}
);
}
function close_record(e)
{
$j("#record-container").html("");
}
</script>
<script type="text/javascript">
$j=jQuery.noConflict();
var initial=0;
<?php
$path=get_bloginfo('template_directory');
echo "var path=\"".$path."\";";
?>
$j(document).ready(function() {
        var visualSearch = VS.init({
          container  : $j('#search_box_container2'),
          query      : '',
          // query      : '',
          unquotable : [
            'text',
            'account',
            'filter',
            'access'
          ],
          callbacks  : {

            search : function(query, searchCollection) {
		      var ap=0;
			  var dataString="{"+searchCollection.serialize()+"}";
			  $j("#record-container").html("");
			  eval('var obj='+dataString);
              $query=$j("search_box_container2");
              $j("#VS").html('<span class="raquo">&raquo;</span> You searched for: <b>' + searchCollection.serialize() + '</b>');
              $j.post(path+'/search-applicants.php',obj, function (data) {
              $j('#table-container').html(data);
              });
              $query.stop().animate({opacity : 1}, {duration: 300, queue: false});
              $query.html('<span class="raquo">&raquo;</span> You searched for: <b>' + searchCollection.serialize() + '</b>');
              clearTimeout(window.queryHideDelay2);
              window.queryHideDelay2 = setTimeout(function() {
                $query.animate({
                  opacity : 0
                }, {
                  duration: 1000,
                  queue: false
                });
              }, 2000);
            },
            valueMatches : function(category, searchTerm, callback) {
              switch (category) {
              case 'account':
                  callback([
                    { value: '1-amanda', label: 'Amanda' },
                    { value: '2-aron',   label: 'Aron' },
                    { value: '3-eric',   label: 'Eric' },
                    { value: '4-jeremy', label: 'Jeremy' },
                    { value: '5-samuel', label: 'Samuel' },
                    { value: '6-scott',  label: 'Scott' }
                  ]);
                  break;
                case 'filter':
                  callback(['published', 'unpublished', 'draft']);
                  break;
                case 'access':
                  callback(['public', 'private', 'protected']);
                  break;
                case 'title':
                  callback([
                    'Pentagon Papers',
                    'CoffeeScript Manual',
                    'Laboratory for Object Oriented Thinking',
                    'A Repository Grows in Brooklyn'
                  ]);
                  break;
                case 'city':
                  callback([
                    'Cleveland',
                    'New York City',
                    'Brooklyn',
                    'Manhattan',
                    'Queens',
                    'The Bronx',
                    'Staten Island',
                    'San Francisco',
                    'Los Angeles',
                    'Seattle',
                    'London',
                    'Portland',
                    'Chicago',
                    'Boston'
                  ])
                  break;
                case 'state':
                  callback([
                    "Alabama", "Alaska", "Arizona", "Arkansas", "California",
                    "Colorado", "Connecticut", "Delaware", "District of Columbia", "Florida",
                    "Georgia", "Guam", "Hawaii", "Idaho", "Illinois",
                    "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana",
                    "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota",
                    "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada",
                    "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina",
                    "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania",
                    "Puerto Rico", "Rhode Island", "South Carolina", "South Dakota", "Tennessee",
                    "Texas", "Utah", "Vermont", "Virginia", "Virgin Islands",
                    "Washington", "West Virginia", "Wisconsin", "Wyoming"
                  ]);
                  break
                case 'country':
                  callback([
                    "China", "India", "United States", "Indonesia", "Brazil",
                    "Pakistan", "Bangladesh", "Nigeria", "Russia", "Japan",
                    "Mexico", "Philippines", "Vietnam", "Ethiopia", "Egypt",
                    "Germany", "Turkey", "Iran", "Thailand", "D. R. of Congo",
                    "France", "United Kingdom", "Italy", "Myanmar", "South Africa",
                    "South Korea", "Colombia", "Ukraine", "Spain", "Tanzania",
                    "Sudan", "Kenya", "Argentina", "Poland", "Algeria",
                    "Canada", "Uganda", "Morocco", "Iraq", "Nepal",
                    "Peru", "Afghanistan", "Venezuela", "Malaysia", "Uzbekistan",
                    "Saudi Arabia", "Ghana", "Yemen", "North Korea", "Mozambique",
                    "Taiwan", "Syria", "Ivory Coast", "Australia", "Romania",
                    "Sri Lanka", "Madagascar", "Cameroon", "Angola", "Chile",
                    "Netherlands", "Burkina Faso", "Niger", "Kazakhstan", "Malawi",
                    "Cambodia", "Guatemala", "Ecuador", "Mali", "Zambia",
                    "Senegal", "Zimbabwe", "Chad", "Cuba", "Greece",
                    "Portugal", "Belgium", "Czech Republic", "Tunisia", "Guinea",
                    "Rwanda", "Dominican Republic", "Haiti", "Bolivia", "Hungary",
                    "Belarus", "Somalia", "Sweden", "Benin", "Azerbaijan",
                    "Burundi", "Austria", "Honduras", "Switzerland", "Bulgaria",
                    "Serbia", "Israel", "Tajikistan", "Hong Kong", "Papua New Guinea",
                    "Togo", "Libya", "Jordan", "Paraguay", "Laos",
                    "El Salvador", "Sierra Leone", "Nicaragua", "Kyrgyzstan", "Denmark",
                    "Slovakia", "Finland", "Eritrea", "Turkmenistan"
                  ]);
                  break;
              }
            },
            facetMatches : function(callback) {
              callback([
                'Email', 'First Name', 'Last Name', 'Sex', 'NRIC', 'Date of Birth', 'Nationality', 'Race','Religion','Singapore PR?','Country of Birth','Marital Status','NS Status','Written','Spoken','Highest Educational Level Attained','Postal Code','Pager/Handphone','Interests','Skills','Availability',
                { label: 'city',    category: 'location' },
                { label: 'address', category: 'location' },
                { label: 'country', category: 'location' },
                { label: 'state',   category: 'location' },
              ]);
            }
          }
        });
      });
    </script>
</div>

<script type="text/javascript">
var $j = jQuery.noConflict();

function get_profile(e) 
{
var id= e.id;
$j.get('wp-content/themes/twentyeleven/approveproc.php?email='+id,function(data){
 $j("#record-container").html(data);
  });


}

</script>
<script type="text/javascript">
function see_record(e)
{
alert("Hi!");
}
</script>
<div id="table-container">
<?php
$sql = "SELECT Email, `First Name`, `Last Name` FROM wp_volunteers_details ORDER BY `Last Name`";

$result = $wpdb->get_results($sql) or die(mysql_error());
$var.="<center><button style=\"margin-bottom:30px;\" onclick=\"close();\">x</button></center>";

echo "<table id=\"approved-table\">";
echo "<tr> <th> Email </th> <th style=\"padding:10px\"> First name </th> <th style=\"padding:10px\"> Last Name</th> </tr>";

foreach($result as $entry)
{
$names = get_object_vars($entry);
echo "<tr id=\"$entry->Email\" class=\"record\" style=\"tr:hover{background-color: red;}\"onclick=\"get_profile(this);\"><td>".$entry->Email."</td>";
echo "<td style=\"padding:10px\">".$names['First Name']."</td>";
echo "<td style=\"padding:10px\">".$names['Last Name']."</td></tr>";
}
echo "</table>";
echo"<form action=\"wp-content/themes/twentyeleven/gen_report.php\" method=\"post\">";
echo "<input type=\"hidden\" name=\"table\" value=\"wp_volunteers_details\"/>";
echo "<center><input type=\"submit\" value=\"Export\"/></center>";

?>
</div>
<div id="record-container" style="margin: 0 auto; width: auto; height: auto;">
</div>

