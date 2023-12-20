@if(checkWillExist(@$will_id) && checkBeneficiarExist(@$will_id) && checkExecutorsExist(@$will_id) &&
checkWitnessCount(@$will_id) > 1)
<a href="javascript:;" data-id="{{@$will_id}}" class="submit_rm bntt_collor pdf_btn pdf_alrt">Generate and Download PDF</a>
<input type="hidden" value="{{checkWitnessExist(@$will_id)}}" class="witnessExist">
@endif