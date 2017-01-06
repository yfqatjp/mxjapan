<div class="row">
    <div class="col-md-5">
        <form action="">
            <h4>Personal Infomation</h4>
            <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                <label>First Name</label>
                <input class="form-control" value="John" type="text" />
            </div>
            <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                <label>Last Name</label>
                <input class="form-control" value="Doe" type="text" />
            </div>
            <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon"></i>
                <label>E-mail</label>
                <input class="form-control" value="johndoe@gmail.com" type="text" />
            </div>
            <div class="form-group form-group-icon-left"><i class="fa fa-phone input-icon"></i>
                <label>Phone Number</label>
                <input class="form-control" value="+1 202 555 0113" type="text" />
            </div>
            <div class="gap gap-small"></div>
            <h4>Location</h4>
            <div class="form-group form-group-icon-left"><i class="fa fa-plane input-icon"></i>
                <label>Home Airport</label>
                <input class="form-control" value="London Heathrow Airport (LHR)" type="text" />
            </div>
            <div class="form-group">
                <label>Street Address</label>
                <input class="form-control" value="46 Gray's Inn Rd, London, WC1X 8LP" type="text" />
            </div>
            <div class="form-group">
                <label>City</label>
                <input class="form-control" value="London" type="text" />
            </div>
            <div class="form-group">
                <label>State/Province/Region</label>
                <input class="form-control" value="London" type="text" />
            </div>
            <div class="form-group">
                <label>ZIP code/Postal code</label>
                <input class="form-control" value="4115523" type="text" />
            </div>
            <div class="form-group">
                <label>Country</label>
                <input class="form-control" value="United Kingdom" type="text" />
            </div>
            <hr>
            <input type="submit" class="btn btn-primary" value="Save Changes">
        </form>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <h4>Change Password</h4>
        <form>
            <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                <label>Current Password</label>
                <input class="form-control" type="password" />
            </div>
            <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                <label>New Password</label>
                <input class="form-control" type="password" />
            </div>
            <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                <label>New Password Again</label>
                <input class="form-control" type="password" />
            </div>
            <hr />
            <input class="btn btn-primary" type="submit" value="Change Password" />
        </form>
    </div>
</div>
<div id="content" class="pt30 pb30">
    <div class="container">

        <div class="alert alert-success" style="display:none;"></div>
        <div class="alert alert-danger" style="display:none;"></div>
        
        <div class="row">
            <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" role="form">
                <div class="col-sm-5">
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['FULLNAME']; ?> *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>"/>
                            <div class="field-notice" rel="name"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['USERNAME']; ?> *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="login" value="<?php echo $login; ?>"/>
                            <div class="field-notice" rel="login"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['EMAIL']; ?> *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>"/>
                            <div class="field-notice" rel="email"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['NEW_PASSWORD']; ?></label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="password" value=""/>
                            <div class="field-notice" rel="password"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['PASSWORD_CONFIRM']; ?></label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="password_confirm" value=""/>
                            <div class="field-notice" rel="password_confirm"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['COMPANY']; ?></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="company" value="<?php echo $company; ?>"/>
                            <div class="field-notice" rel="company"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['ADDRESS']; ?> *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="address" value="<?php echo $address; ?>"/>
                            <div class="field-notice" rel="address"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['POSTCODE']; ?> *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="postcode" value="<?php echo $postcode; ?>"/>
                            <div class="field-notice" rel="postcode"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['CITY']; ?> *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="city" value="<?php echo $city; ?>"/>
                            <div class="field-notice" rel="city"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['COUNTRY']; ?> *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="country">
                                <option value="0">-</option>
                                <?php
                                $result_country = $db->query("SELECT * FROM pm_country");
                                if($result_country !== false){
                                    foreach($result_country as $i => $row){
                                        $id_country = $row['id'];
                                        $country_name = $row['name'];
                                        $selected = ($country == $country_name) ? " selected=\"selected\"" : "";
                                        
                                        echo "<option value=\"".$country_name."\"".$selected.">".$country_name."</option>";
                                    }
                                } ?>
                            </select>
                            <div class="field-notice" rel="country"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['PHONE']; ?> *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>"/>
                            <div class="field-notice" rel="phone"></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 control-label"><?php echo $texts['MOBILE']; ?></label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>"/>
                            <div class="field-notice" rel="mobile"></div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <span class="col-sm-12"><button type="submit" class="btn btn-primary" name="edit"><i class="fa fa-pencil"></i> <?php echo $texts['EDIT']; ?></button> <i> * <?php echo $texts['REQUIRED_FIELD']; ?></i></span>
                    </div>
                </div>
            </form>
            <div class="col-sm-3">
                
            </div>
        </div>
    </div>
</div>