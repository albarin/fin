<?php

function document_path($filename)
{
    return "storage/app/documents/$filename";
}

function full_document_path($documentPath)
{
    return base_path($documentPath);
}