<?php

// SUCCESS/ERROR SESSION-FLASH MESSAGE SHOW...
function setMessage($type, $message) {
    session()->flash('type', $type);
    session()->flash('message', $message);
}
