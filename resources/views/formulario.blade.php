<div class="row">
    <form class="form" method="POST" action="{{url('/oracle')}}">
        {!! csrf_field() !!}
        
        <div class="form-group col-md-3">
            <div class="input-group col-md-4" style="width: 100%;">
            <span class="input-group-addon">Ação</span>
                <select name="acao" class="form-control">
                    <option value="BIDI4">Banco Inter SA - BIDI4</option>
                    <option value="LINX3">Linx SA - LINX3</option>
                    <option value="MGLU3">Magazine Luiza SA - MGLU3</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-3" >
            <div class="input-group">
                <button class="btn btn-success btn-add" type="submit"><span class="glyphicon glyphicon-refresh"></span> Calcular </button>
            </div>
        </div>
    </form>
</div>