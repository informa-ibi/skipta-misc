<script type="text/javascript">
    
    function Person()
{
  //properties/fields
  this.name = '<?php echo $this->tinyObject->UserId; ?>';
  this.height = 68;
  this.weight = 170;
  this.socialInsuranceNumber = '';

  //methods/actions
  this.setHeight = function(height) {this.height=height;}
  this.getHeight = function() { return this.height; }
  this.setWeight = function(weight) {this.weight = weight;}
  this.getWeight = function() { return this.weight; }
  this.setName   = function(name) {this.name=name;}
  this.getName   = function() { return this.name; }
  this.setSocialInsuranceNumber = function(socialInsuranceNumber) { this.socialInsuranceNumber=socialInsuranceNumber; }

  return this;
}

</script>