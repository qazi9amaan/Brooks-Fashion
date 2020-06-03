<div class="row">
    <div class="col-md-4">
        <input type="text" name="full_name"  value="<?php echo ($edit ? $customer['full_name'] : ''); ?>" placeholder="Full Name" required>
        <span class="required-star">*</span>
    </div>
   
    <div class="col-md-4">
        <input type="email" name="email_address"  value="<?php echo ($edit ? $customer['email_address'] : ''); ?>" placeholder="Email Address" required>
        <span class="required-star">*</span>
    </div>
    <div class="col-md-4">
        <input type="text" name="phone" pattern="[0-9]{10}" value="<?php echo ($edit ? $customer['phone'] : ''); ?>" placeholder="Phone " required>
        <span class="required-star">*</span>
    </div>

    <div class="col-12">
        <input type="text" name="init_address"  value="<?php echo ($edit ? $customer['init_address'] : ''); ?>" placeholder="Flat, House no., Building, Company,Apartment" required>
        <span class="required-star">*</span>
    </div>

   
    <div class="col-md-6">
        <input type="text" name="final_address"  value="<?php echo ($edit ? $customer['final_address'] : ''); ?>" placeholder="Area, Colony, Street, Sector" required>
        <span class="required-star">*</span>
    </div>
    <div class="col-md-6">
        <input type="text" name="landmark"  value="<?php echo ($edit ? $customer['landmark'] : ''); ?>" placeholder="Landmark" required>
        <span class="required-star">*</span>
    </div>

    <div class="col-md-4">
        <input type="text" name="town"  value="<?php echo ($edit ? $customer['town'] : ''); ?>" placeholder="Town/City" required>
        <span class="required-star">*</span>
        </div>   
    <div class="col-md-4">
        <input type="number" name="pincode" pattern="[0-9]{6}" value="<?php echo ($edit ? $customer['pincode'] : ''); ?>" placeholder="Pincode" required>
        <span class="required-star">*</span>
    </div>   
    <div class="col-md-4">
        <input type="text" name="state" value="<?php echo ($edit ? $customer['state'] : ''); ?>" placeholder="State" required>
        <span class="required-star">*</span>
    </div>   


 <div class="col-lg-8 col-md-12">
        <button type="submit" class="btn black">Create </button>
    </div>
</div>

