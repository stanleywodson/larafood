@extends('site.layouts.app')

@section('content')
<div class="text-center">
    <h1 class="title-plan">Escolha o plano</h1>
</div>
<div class="row">
    
        <div class="col-md-4 col-sm-6">
            <div class="pricingTable">
                <div class="pricing-content">
                    <div class="pricingTable-header">
                        <h3 class="title"></h3>
                    </div>
                    <div class="inner-content">
                        <div class="price-value">
                            <span class="currency">R$</span>
                            <span class="amount"></span>
                            <span class="duration">Por Mês</span>
                        </div>
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="pricingTable-signup">
                    <a href="">Assinar</a>
                </div>
            </div>
        </div><!--end-->
    
</div>
@endsection
