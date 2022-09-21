<form id="form-decrypt">
    <input type="hidden" class="input-url" name="url"/>
    <div class="form-group">
        <label>Enter passphrase</label>
        <input type="text" class="form-control" id="input-pass" name="passphrase">
    </div>  
    <button type="submit" class="btn btn-primary decrypt-submit">Submit</button>
</form>

<div class="result-form">
    <div class="form-group">
        <label>Message</label>
        <textarea type="text" class="form-control" id="input-msg" rows="15" disabled></textarea>
    </div>
    <button class="btn btn-primary btn-home">Go To Home</button>
</div>