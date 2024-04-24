

    <div class="recla" id="recBanner">
        <div class="reclaBanner">
            <div class="header">
                <h1>Reclamer</h1>
                <h1 onclick="closeReclam()" style="cursor : pointer">X</h1>
            </div>
            <input type="hidden" id="id_reclamateur" name="id_reclamateur"/>
            <input type="hidden" id="id_T" name="id_T"/>
            <input type="hidden" id="type_reclamation" name="type_reclamation"/>
            <input type="hidden" id="type_reclamateur" name="type_reclamateur"/>
            <div>
                <label>Type de Reclamation : </label>
                <div class="radios">
                    <label><input type="radio" name="typeReclam" value="Racism" placeholder="Racism" checked/> Rascism</label>
                    <label><input type="radio" name="typeReclam" value="Gros mots" placeholder="Gros Mots"/> Gros Mots</label>
                    <label><input id="autreRadio" type="radio" name="typeReclam" value="Autre" placeholder="Autre"/> Autre</label>
                </div>
            </div>
            <div id="autre">
                <label>Decris nous le probleme : </label>
                <textarea name="autre" col="50" rows="5" id="autreText"></textarea>
            </div>
            <button onclick="sendReclamation()">Reclamer</button>
        </div>
    </div>
