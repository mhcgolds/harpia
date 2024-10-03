<?php

namespace Mhcgolds\Harpia;

enum EPatern: string
{
    case ALPHA_LOWERCASE = 'a-z';
    case ALPHA_UPPERCASE = 'A-Z';
    case ALPHA_ALL = 'a-zA-Z';
    case NUMERIC = '0-9';
    case SPECIAL_CHARS = '@#!$&_\.';
}