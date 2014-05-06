#! /usr/bin/perl -w
use lib '/opt/kilroy/lib/perl';
use strict;
use CGI qw/:standard/;
use DBI;
my $dbh = DBI->connect('dbi:mysql:fidukj40', 'fidukj40', 'mysqlpass')
 or die "Connection Error: $DBI::errstr\n";;

my $q = new CGI;
my $filename = $q->param('file');

open(my $fh, '<', $filename);

while (my $row = <$fh>) {
    my @fields = split(/,/, $row);
    my $statement = $dbh->prepare("insert into sub_trivia(question,correct_answer,fake1,fake2,fake3) values(?,?,?,?,?)");
    $statement->execute($fields[0],$fields[1],$fields[2],$fields[3],$fields[4]);
}
close $fh;
print redirect(-url=>'./index.php');
