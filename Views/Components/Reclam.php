

    <div class="recla" id="recBanner">
        <div class="reclaBanner">
            <div class="header">
                <h1>Reclamer</h1>
            </div>
            <div class="close">
                <p onclick="closeReclam()" style="cursor : pointer">X</p>
            </div>
            <input type="hidden" id="id_reclamateur" name="id_reclamateur"/>
            <input type="hidden" id="id_T" name="id_T"/>
            <input type="hidden" id="type_reclamation" name="type_reclamation"/>
            <input type="hidden" id="type_reclamateur" name="type_reclamateur"/>
            <div>
                <h2>Type de Reclamation : </h2>
                <div class="radios">
                    <label><input id="rascismRadio"type="radio" name="typeReclam" value="Racism" placeholder="Racism" checked/> Rascism</label>
                    <label><input id="bRadio" type="radio" name="typeReclam" value="Gros mots" placeholder="intimidation"/> intimidation</label>
                    <label><input id="autreRadio" type="radio" name="typeReclam" value="Autre" placeholder="Autre"/> Autre</label>
                </div>
            </div>
            <div id="autre">
                <h2>Decris nous le probleme : </h2>
                <textarea name="autre" col="50" rows="5" id="autreText"></textarea>
            </div>
            <button onclick="sendReclamation()">Reclamer</button>
        </div>
    </div>
