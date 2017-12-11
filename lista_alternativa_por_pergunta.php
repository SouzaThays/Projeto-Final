
<?php
require_once('controller/ControleEnquete.php');
Enquete('consultarAlternativa');
?>


  <div class="demo-masked-input">
	<div class="row clearfix">
		<div class="col-md-12">
			<b>Alternativa</b>
			<select id="fkAlternativa" class="ms" multiple="multiple"><?php while ($row = mysqli_fetch_array($rsAlternativa)) { ?>
				<option value="<?php echo $row['idAlternativas']; ?>"><?php echo $row['descricaoAlt']; ?></option><?php } ?>
			</select>
		</div>
	</div>
</div>


<script>

    (function () {



        $('#fkAlternativa').multiSelect({
            afterSelect: function (values1) {
              
                $('<input/>', {
                    type: 'hidden',
                    name: 'ListaAlternativa[]',
                    value: values1

                }).appendTo('#form');
            },
            afterDeselect: function (values2) {


                $('<input/>', {
                    type: 'hidden',
                    name: 'ListaAlternativa[]',
                    value: values2
                }).appendTo('#form');

            }
        });
    })(jQuery);



 

</script>