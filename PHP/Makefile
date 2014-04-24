# Sample Makefile for Web Programming students
#
# by Darren Provine, 14 September 2002

# NOTE: this Makefile does _not_ install "Connect.php".
# That file has a MySQL password in it in plain text, so we don't
# copy it over to where the webserver might deliver it to someone.
# This makes it less likely that we'll have security problems.
# (Only "less likely", but that's all you can really hope for.)

# These lines should be the only ones you have to change for many
# projects.
DESTDIR = /export/home/yeunga46/public_html/web/PHP/
TARGETS = DBfuncs.php add.php delete.php search.php show.php foot.php index.html quiz.html highscore.php
SOURCES = DBfuncs.php add.php delete.php search.php show.php foot.php index.html quiz.html highscore.php


# This target is just here to be the top target in the Makefile.
# There's nothing to compile for this one.
all: $(TARGETS)

# You might want to look up mkdir(1) to see about that -p flag.
install: $(TARGETS)
	@if [ ! -d $(DESTDIR) ] ; then mkdir -p $(DESTDIR); fi
	@for f in $(TARGETS)                 ; \
	do                                     \
		/usr/bin/install -v -t $(DESTDIR) -m 444 $$f ; \
	done

# Note that here we don't blow away the directory, and so we
# be sure and tell the user.  The reason not to delete the
# directory is that it may have other files in it.  Checking
# for, and deleting, any such files will have to be done manually.
# (How could this be improved?)
#
# Note also that the @ sign keeps the echo lines from being echoed
# before they are run.  (That could be confusing.)  This little
# trick (and many more) can be discovered by consulting make(1S).
deinstall:
	cd $(DESTDIR) ; /bin/rm -f $(TARGETS)
@echo "   ==>   removed file(s): $(TARGETS)"
@echo "   ==>   left directory : $(DESTDIR)"

redo: deinstall install

clean:
	/bin/rm -f core $(TARGETS)
