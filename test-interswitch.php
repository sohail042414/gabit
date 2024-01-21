
<form method="post" action="https://sandbox.interswitchng.com/collections/w/pay">
<!-- REQUIRED HIDDEN FIELDS -->
<input name="product_id" type="hidden" value="1076" />
<input name="pay_item_id" type="hidden" value="101" />
<input name="amount" type="hidden" value="3000" />
<input name="currency" type="hidden" value="566" />
<input name="site_redirect_url" type="hidden" value="http://www.giveyourbit.com/test.php"/>
<input name="txn_ref" type="hidden" value="4327408aaaaa" />
<input name="cust_id" type="hidden" value="000001"/>
<input name="site_name" type="hidden" value="www.giveyourbit.com "/>
<input name="cust_name" type="hidden" value="Test Customer" />
<input name="hash" type="hidden" value="3de9854cd1c96faf70a2853b98dce565fb39951901219aca8f394536773d5b73fdd5f59efe25561fd1d00f14be2b4b13b6f055aad4eba39b77b7e373fc8d9a68" />
</br></br>
<input type="submit" value="PAY NOW"></input>
</form>
<?php

print_r($_REQUEST);
    ?>