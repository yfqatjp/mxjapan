<?php
$javascripts[] = DOCBASE."js/plugins/jquery-activmap/js/markercluster.min.js";
$javascripts[] = DOCBASE."js/plugins/jquery-activmap/js/jquery-activmap.js";
$stylesheets[] = array("file" => DOCBASE."js/plugins/jquery-activmap/css/jquery-activmap.css", "media" => "all");

require(SYSBASE."templates/".TEMPLATE."/common/header.php"); ?>

<script>
    var locations = [
        <?php
        $result_location = $db->query("SELECT * FROM pm_location WHERE checked = 1 AND pages REGEXP '(^|,)".$page_id."(,|$)'");
        if($result_location !== false){
            $nb_locations = $db->last_row_count();
            foreach($result_location as $i => $row){
                $location_name = $row['name'];
                $location_address = $row['address'];
                $location_lat = $row['lat'];
                $location_lng = $row['lng'];

                echo "{title: '".addslashes($location_name)."', address: '".addslashes($location_address)."', url: '', tags: [], lat: ".$location_lat.", lng: ".$location_lng.", img: '', icon: ''}";
                if($i+1 < $nb_locations) echo ",\n";
            }
        } ?>
    ];
</script>

<section id="page">
    
    <?php include(SYSBASE."templates/".TEMPLATE."/common/page_header.php"); ?>
    
    <div id="content" class="clearfix">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 pt20">
                    
                    <a id="activmap-reset" class="btn btn-default" href="#"><i class="fa fa-ban"></i> Reset</a>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                            <input id="activmap-location" type="text" class="form-control" name="location" value="" placeholder="Location...">
                        </div>
                        <p>
                            Radius: 
                            <input type="radio" name="activmap_radius" value="0"> None
                            <input type="radio" name="activmap_radius" value="3"> 3 km
                            <input type="radio" name="activmap_radius" value="20"> 20 km
                            <input type="radio" name="activmap_radius" value="50"> 50 km
                            <input type="radio" name="activmap_radius" value="100"> 100 km
                        </p>
                    </div>
                    
                    <a id="activmap-geolocate" class="btn btn-default" href="#"><i class="fa fa-crosshairs"></i> Geolocate</a>

                    <!-- Activ'Map categories and tags -->
                    <div class="panel-group" id="activmap-accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse-services">
                                        <i class="fa fa-bank"></i> Services &amp; Equipments
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-services" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <input type="checkbox" name="marker_type[]" value="services_01"> Culture<br>
                                    <input type="checkbox" name="marker_type[]" value="services_02"> Health<br>
                                    <input type="checkbox" name="marker_type[]" value="services_03"> Places of worship<br>
                                    <input type="checkbox" name="marker_type[]" value="services_04"> Safety<br>
                                    <input type="checkbox" name="marker_type[]" value="services_05"> Schools<br>
                                    <input type="checkbox" name="marker_type[]" value="services_06"> Sports
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapse-shops">
                                        <i class="fa fa-shopping-cart"></i> Shops
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-shops" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <input type="checkbox" name="marker_type[]" value="shops_01"> Beauty<br>
                                    <input type="checkbox" name="marker_type[]" value="shops_02"> Clothes &amp; Jewels<br>
                                    <input type="checkbox" name="marker_type[]" value="shops_03"> Food<br>
                                    <input type="checkbox" name="marker_type[]" value="shops_04"> Services
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" href="#collapse-tourism">
                                        <i class="fa fa-suitcase"></i> Tourism
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-tourism" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <input type="checkbox" name="marker_type[]" value="tourism_01"> Hotels<br>
                                    <input type="checkbox" name="marker_type[]" value="tourism_02"> Monuments<br>
                                    <input type="checkbox" name="marker_type[]" value="tourism_03"> Museums
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div id="activmap-wrapper">
                        <!-- Places panel (auto removable) -->
                        <div id="activmap-places" class="hidden-xs">
                            <div id="activmap-results-num"></div>
                        </div>
                        <!-- Map wrapper -->
                        <div id="activmap-canvas"></div>
                    </div>  
                </div>  
            </div>         
        </div>
    </div>
</section>
