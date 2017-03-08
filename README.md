### Capture Tout video files

#### Setup

First, gather the data about your Touts from the Partner Dashboard using ParseHub following the (instructions in this Google Document)[https://docs.google.com/document/d/1FxDMNJSFLGRnsdKor2lk5WRKmA_y8yAUQ8Y9fa-ynK8/edit].

Ensure that your formulae gather the:

- Contributor's name
- Description
- Date Published
- Number of views
- Video URL

My formula wound up capturing an empty field before the URL, but I just ignored it. Here's a sample output line from ParseHub:

```"Mike Chambers","Watch: Mikko Rantanen gets first NHL point in #Avs' 1-0 win over Minnesota","Sat, 05 Nov 2016 22:13:46 +0000","54","","http://videos.tout.com/dry/mp4/cdf5d6e0086d4fd0.mp4"```

When you've captured all your details, download them as CSV (and combine them if it took multiple runs), and delete the header row. Rename the file `tout.csv`.

Get this repository and put it where you want your touts to be saved.

Move `tout.csv` here.

Make sure `failed.csv` and `new_touts.csv` are empty files.

Make sure `touts` is an empty directory that PHP will have permission to write to -- this is where your downloaded videos will go.

If for any reason the script can't download and rename the video file, it will add a record to `failed.csv` so you can try again afterward.

When it succeeds at downloading a Tout video file and saving it, a record is added to `new_touts.csv` so you have an index of the descriptions, view, publication dates, etc., associated with the new file name.

#### Run

Type `php get-touts.php` and hit ENTER.

Wait a while and it will download them all, rename the files to a format like `00000-troy-renck-1448230365.mp4` which is:

- number of views (with leading zeroes up to five digits)
- name of contributor
- Unix timestamp of the date published

This should make all the filenames unique, and allow you to sort the results by the number of views to help determine priority as you move the videos to other platforms or look for htose that you know performed well.

#### Feel free to modify this script to fit your needs.