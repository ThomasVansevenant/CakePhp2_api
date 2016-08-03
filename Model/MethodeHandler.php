<?php

/**
 * Interface for methodeHandling (Strategy Pattern)
 *
 * @author thomas
 */
interface MethodeHandler {
    public function handle(ApiController $controller);
}
