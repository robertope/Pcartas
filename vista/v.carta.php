<div id="#CARTA#">
    <div class="imagen">
        <img src="img/cartas/#IMAGEN#" draggable="true" ondragstart="arrastrar(event)">
    </div>
    <br/>
    <input class="cantidad" value="0" type="number" min="0" max="#CANTIDAD#" onchange="maximo(this)"><Span>/#CANTIDAD#</Span>
    <button class="poner">Poner</button>
    <input type="hidden" value="#TIPO#" class="tipo">
</div>
