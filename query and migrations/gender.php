
 <input type="radio" name="gender" value="2" id="gender" {{ ((@$data->gender == 2) ? "checked": '') }}> &nbsp Female
 <input type="radio" name="gender" value="1" id="gender" {{ (@$data->gender == 1 ? "checked": '') }}> &nbsp Male