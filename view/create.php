

<form id="form-create">
    <div class="form-group">
        <label>Enter your secret message</label>
        <textarea type="" class="form-control" id="input-msg" name="msg" rows="15" maxlength="3000"></textarea>
    </div>
    <div class="form-group">
        <label>Enter your secret passphrase</label>
        <input type="text" class="form-control" id="input-pass" name="passphrase">
    </div>
    <div class="form-group">
        <label>Select expiry (default max is 7 days)</label>
        <select class="form-control" id="input-expiry" name="exiry">
            <option value="300">5 min</option>
            <option value="1800">30 min</option>
            <option value="3600">1 hour</option>
            <option value="14400">4 hour</option>
            <option value="43200">12 hour</option>
            <option value="86400">24 hour</option>
            <option value="259200">3 day</option>
            <option value="432000">5 day</option>
            <option value="604800" selected>7 day</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary create-submit">Submit</button>
</form>

<div class="result-form">
    <a href="" style="display: block;" style="margin-bottom: 15px;">Here's your link</a>
    <input type="text" class="form-control" id="input-copy" style="margin: 15px 0;"/>
    <span>Your link will expire on</span>
    <span class="expiry-time"></span>
    </br>
    <button class="btn btn-primary btn-copy">Copy Info</button>
</div>

