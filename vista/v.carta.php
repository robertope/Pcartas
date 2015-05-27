<div id="#CARTA#">
    <div class="imagen">
        <img src="img/cartas/#IMAGEN#" draggable="true" ondragstart="arrastrar(event)">
    </div>
    <br/>
    <input class="cantidad" value="1" type="number" min="0" max="#CANTIDAD#" onchange="maximo(this)" maxlength="3"><Span>/#CANTIDAD#</Span>
    <button class="poner">Poner</button><button class="quitar">Quitar</button>
    <input type="hidden" value="#TIPO#" class="tipo">
</div>
