#! /usr/bin/perl -w

# Scrape1.cgi - demonstrate screen-scraping in Perl
# A Yeung

use strict;
use CGI;
use WWW::Mechanize;     # This is the object that gets stuff
use HTML::TokeParser;   # This is the object that parses HTML

my $cgi = new CGI;
print $cgi->header(-type=>'text/html'),
      $cgi->start_html( -title => 'Screen Scrape',-meta => {
		 'generator' => 'notepad++',
		 'Author' => 'Andy Yeung'
		 });



print $cgi->table({-border=>1, cellpadding=>3},
$cgi->Tr([
		$cgi->th(['#', 'Name', 'Score'])
	]),
);

# ALL DONE!
print $cgi->end_html, "\n";

