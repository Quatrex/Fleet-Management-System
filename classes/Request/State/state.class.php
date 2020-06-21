<?php 
namespace Request\State;

use Request\Request;

abstract class State {

    public function cancel(Request $request) : void {
        echo "Invalid transition";
    }

    public function justify(Request $request) : void {
        echo "Invalid transition";
    }

    public function denyJustify(Request $request) : void {
        echo "Invalid transition";
    }

    public function approve(Request $request) : void {
        echo "Invalid transition";
    }

    public function denyApprove(Request $request) : void {
        echo "Invalid transition";
    }
}