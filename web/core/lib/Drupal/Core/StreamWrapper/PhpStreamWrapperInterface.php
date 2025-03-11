<?php

namespace Drupal\Core\StreamWrapper;

/**
 * Defines a generic PHP stream wrapper interface.
 *
 * @see http://php.net/manual/class.streamwrapper.php
 */
interface PhpStreamWrapperInterface {

  /**
   * Close directory handle.
   *
   * This method is called in response to closedir(). Any resources which were
   * locked, or allocated, during opening and use of the directory stream
   * should be released.
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure.
   *
   * @see closedir()
   * @see http://php.net/manual/en/streamwrapper.dir-closedir.php
   */
  public function dir_closedir();

  /**
   * Open directory handle.
   *
   * This method is called in response to opendir().
   *
   * @param string $path
   *   Specifies the URL that was passed to opendir().
   * @param int $options
   *   Whether or not to enforce safe_mode (0x04).
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure.
   *
   * @see opendir()
   * @see http://php.net/manual/en/streamwrapper.dir-opendir.php
   */
  public function dir_opendir($path, $options);

  /**
   * Read entry from directory handle.
   *
   * This method is called in response to readdir().
   *
   * @return string|false
   *   Should return string representing the next filename, or FALSE if there
   *   is no next file. Note, the return value will be casted to string.
   *
   * @see readdir()
   * @see http://php.net/manual/en/streamwrapper.dir-readdir.php
   */
  public function dir_readdir();

  /**
   * Rewind directory handle.
   *
   * This method is called in response to rewinddir(). Should reset the output
   * generated by PhpStreamWrapperInterface::dir_readdir. The next call to
   * PhpStreamWrapperInterface::dir_readdir should return the first entry in the
   * location returned by PhpStreamWrapperInterface::dir_opendir.
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure.
   *
   * @see rewinddir()
   * @see PhpStreamWrapperInterface::dir_readdir()
   * @see http://php.net/manual/en/streamwrapper.dir-rewinddir.php
   */
  public function dir_rewinddir();

  /**
   * Create a directory.
   *
   * This method is called in response to mkdir()
   *
   * Note, in order for the appropriate error message to be returned this method
   * should not be defined if the wrapper does not support creating directories.
   *
   * Note, the streamWrapper::$context property is updated if a valid context is
   * passed to the caller function.
   *
   * @param string $path
   *   Directory which should be created.
   * @param int $mode
   *   The value passed to mkdir().
   * @param int $options
   *   A bitwise mask of values, such as STREAM_MKDIR_RECURSIVE.
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure.
   *
   * @see mkdir()
   * @see PhpStreamWrapperInterface::rmdir()
   * @see http://php.net/manual/en/streamwrapper.mkdir.php
   */
  public function mkdir($path, $mode, $options);

  /**
   * Renames a file or directory.
   *
   * This method is called in response to rename(). Should attempt to rename
   * $path_from to $path_to.
   *
   * Note, in order for the appropriate error message to be returned this method
   * should not be defined if the wrapper does not support renaming files.
   *
   * Note, the streamWrapper::$context property is updated if a valid context is
   * passed to the caller function.
   *
   * @param string $path_from
   *   The URL to the current file.
   * @param string $path_to
   *   The URL which the $path_from should be renamed to.
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure.
   *
   * @see rename()
   * @see http://php.net/manual/en/streamwrapper.rename.php
   */
  public function rename($path_from, $path_to);

  /**
   * Removes a directory.
   *
   * This method is called in response to rmdir().
   *
   * Note, in order for the appropriate error message to be returned this method
   * should not be defined if the wrapper does not support removing directories.
   *
   * Note, the streamWrapper::$context property is updated if a valid context is
   * passed to the caller function.
   *
   * @param string $path
   *   The directory URL which should be removed.
   * @param int $options
   *   A bitwise mask of values, such as STREAM_MKDIR_RECURSIVE.
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure.
   *
   * @see rmdir()
   * @see PhpStreamWrapperInterface::mkdir()
   * @see PhpStreamWrapperInterface::unlink()
   * @see http://php.net/manual/en/streamwrapper.rmdir.php
   */
  public function rmdir($path, $options);

  /**
   * Retrieve the underlying stream resource.
   *
   * This method is called in response to stream_select().
   *
   * @param int $cast_as
   *   Can be STREAM_CAST_FOR_SELECT when stream_select() is calling
   *   stream_cast() or STREAM_CAST_AS_STREAM when stream_cast() is called for
   *   other uses.
   *
   * @return resource|false
   *   The underlying stream resource or FALSE if stream_select() is not
   *   supported.
   *
   * @see stream_select()
   * @see http://php.net/manual/streamwrapper.stream-cast.php
   */
  public function stream_cast($cast_as);

  /**
   * Closes stream.
   *
   * This method is called in response to fclose(). All resources that were
   * locked, or allocated, by the wrapper should be released.
   *
   * @see fclose()
   * @see PhpStreamWrapperInterface::dir_closedir()
   * @see http://php.net/manual/en/streamwrapper.stream-close.php
   */
  public function stream_close();

  /**
   * Tests for end-of-file on a file pointer.
   *
   * This method is called in response to feof().
   *
   * Warning, when reading the whole file (for example, with
   * file_get_contents()), PHP will call
   * PhpStreamWrapperInterface::stream_read() followed by
   * PhpStreamWrapperInterface::stream_eof() in a loop but as long as
   * PhpStreamWrapperInterface::stream_read() returns a non-empty string, the
   * return value of PhpStreamWrapperInterface::stream_eof() is ignored.
   *
   * @return bool
   *   Should return TRUE if the read/write position is at the end of the
   *   stream and if no more data is available to be read, or FALSE otherwise.
   *
   * @see feof()
   * @see http://php.net/manual/en/streamwrapper.stream-eof.php
   */
  public function stream_eof();

  /**
   * Flushes the output.
   *
   * This method is called in response to fflush() and when the stream is being
   * closed while any un-flushed data has been written to it before. If you have
   * cached data in your stream but not yet stored it into the underlying
   * storage, you should do so now.
   *
   * Note, if not implemented, FALSE is assumed as the return value.
   *
   * @return bool
   *   Should return TRUE if the cached data was successfully stored (or if
   *   there was no data to store), or FALSE if the data could not be stored.
   *
   * @see fflush()
   * @see http://php.net/manual/en/streamwrapper.stream-flush.php
   */
  public function stream_flush();

  /**
   * Advisory file locking.
   *
   * This method is called in response to flock(), when file_put_contents()
   * (when flags contains LOCK_EX), stream_set_blocking() and when closing the
   * stream (LOCK_UN).
   *
   * @param int $operation
   *   One of:
   *   - LOCK_SH: To acquire a shared lock (reader).
   *   - LOCK_EX: To acquire an exclusive lock (writer).
   *   - LOCK_UN: To release a lock (shared or exclusive).
   *   - LOCK_NB: If you don't want flock() to block while locking. This
   *     operation is not supported on Windows.
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure.
   *
   * @see flock()
   * @see stream_set_blocking()
   * @see http://php.net/manual/en/streamwrapper.stream-lock.php
   */
  public function stream_lock($operation);

  /**
   * Sets metadata on the stream.
   *
   * @param string $path
   *   A string containing the URI to the file to set metadata on.
   * @param int $option
   *   One of:
   *   - STREAM_META_TOUCH: The method was called in response to touch().
   *   - STREAM_META_OWNER_NAME: The method was called in response to chown()
   *     with string parameter.
   *   - STREAM_META_OWNER: The method was called in response to chown().
   *   - STREAM_META_GROUP_NAME: The method was called in response to chgrp().
   *   - STREAM_META_GROUP: The method was called in response to chgrp().
   *   - STREAM_META_ACCESS: The method was called in response to chmod().
   * @param mixed $value
   *   If option is:
   *   - STREAM_META_TOUCH: Array consisting of two arguments of the touch()
   *     function.
   *   - STREAM_META_OWNER_NAME or STREAM_META_GROUP_NAME: The name of the owner
   *     user/group as string.
   *   - STREAM_META_OWNER or STREAM_META_GROUP: The value of the owner
   *     user/group as integer.
   *   - STREAM_META_ACCESS: The argument of the chmod() as integer.
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure. If $option is not
   *   implemented, FALSE should be returned.
   *
   * @see http://php.net/manual/streamwrapper.stream-metadata.php
   */
  public function stream_metadata($path, $option, $value);

  /**
   * Opens file or URL.
   *
   * This method is called immediately after the wrapper is initialized (e.g.
   * by fopen() and file_get_contents()).
   *
   * Note the streamWrapper::$context property is updated if a valid context
   * is passed to the caller function.
   *
   * @param string $path
   *   Specifies the URL that was passed to the original function. Note that
   *   the URL can be broken apart with parse_url(). Note that only URLs
   *   delimited by "://" are supported. ":" and ":/" while technically valid
   *   URLs, are not.
   * @param string $mode
   *   The mode used to open the file, as detailed for fopen(). Note, remember
   *   to check if the mode is valid for the path requested.
   * @param int $options
   *   Holds additional flags set by the streams API. It can hold one or more
   *   of the following values ORed together:
   *   - STREAM_USE_PATH: If path is relative, search for the resource using
   *     the include_path.
   *   - STREAM_REPORT_ERRORS: If this flag is set, you are responsible for
   *     raising errors using trigger_error() during opening of the stream. If
   *     this flag is not set, you should not raise any errors.
   * @param string $opened_path
   *   If the path is opened successfully, and STREAM_USE_PATH is set in
   *   options, opened_path should be set to the full path of the file/resource
   *   that was actually opened.
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure.
   *
   * @see fopen()
   * @see parse_url()
   * @see http://php.net/manual/en/streamwrapper.stream-open.php
   */
  public function stream_open($path, $mode, $options, &$opened_path);

  /**
   * Read from stream.
   *
   * This method is called in response to fread() and fgets().
   *
   * Note, remember to update the read/write position of the stream (by the
   * number of bytes that were successfully read).
   *
   * Note, PhpStreamWrapperInterface::stream_eof() is called directly after
   * calling PhpStreamWrapperInterface::stream_read() to check if EOF has been
   * reached. If not implemented, EOF is assumed.
   *
   * Warning, when reading the whole file (e.g., with file_get_contents()), PHP
   * will call PhpStreamWrapperInterface::stream_read() followed by
   * PhpStreamWrapperInterface::stream_eof() in a loop but as long as
   * PhpStreamWrapperInterface::stream_read() returns a non-empty string, the
   * return value of PhpStreamWrapperInterface::stream_eof() is ignored.
   *
   * @param int $count
   *   How many bytes of data from the current position should be returned.
   *
   * @return string|false
   *   If there are less than $count bytes available, return as many as are
   *   available. If no more data is available, return either FALSE or an empty
   *   string.
   *
   * @see fread()
   * @see fgets()
   * @see http://php.net/manual/en/streamwrapper.stream-read.php
   */
  public function stream_read($count);

  /**
   * Seeks to specific location in a stream.
   *
   * This method is called in response to fseek().
   *
   * The read/write position of the stream should be updated according to the
   * offset and whence.
   *
   * @param int $offset
   *   The byte offset to seek to.
   * @param int $whence
   *   Possible values:
   *   - SEEK_SET: Set position equal to offset bytes.
   *   - SEEK_CUR: Set position to current location plus offset.
   *   - SEEK_END: Set position to end-of-file plus offset.
   *   Defaults to SEEK_SET.
   *
   * @return bool
   *   TRUE if the position was updated, FALSE otherwise.
   *
   * @see http://php.net/manual/streamwrapper.stream-seek.php
   */
  public function stream_seek($offset, $whence = SEEK_SET);

  /**
   * Change stream options.
   *
   * This method is called to set options on the stream.
   *
   * @param int $option
   *   One of:
   *   - STREAM_OPTION_BLOCKING: The method was called in response to
   *     stream_set_blocking().
   *   - STREAM_OPTION_READ_TIMEOUT: The method was called in response to
   *     stream_set_timeout().
   *   - STREAM_OPTION_WRITE_BUFFER: The method was called in response to
   *     stream_set_write_buffer().
   * @param int $arg1
   *   If option is:
   *   - STREAM_OPTION_BLOCKING: The requested blocking mode:
   *     - 1 means blocking.
   *     - 0 means not blocking.
   *   - STREAM_OPTION_READ_TIMEOUT: The timeout in seconds.
   *   - STREAM_OPTION_WRITE_BUFFER: The buffer mode, STREAM_BUFFER_NONE or
   *     STREAM_BUFFER_FULL.
   * @param int $arg2
   *   If option is:
   *   - STREAM_OPTION_BLOCKING: This option is not set.
   *   - STREAM_OPTION_READ_TIMEOUT: The timeout in microseconds.
   *   - STREAM_OPTION_WRITE_BUFFER: The requested buffer size.
   *
   * @return bool
   *   TRUE on success, FALSE otherwise. If $option is not implemented, FALSE
   *   should be returned.
   */
  public function stream_set_option($option, $arg1, $arg2);

  /**
   * Retrieve information about a file resource.
   *
   * This method is called in response to fstat().
   *
   * @return array|false
   *   See stat().
   *
   * @see stat()
   * @see PhpStreamWrapperInterface::url_stat()
   * @see http://php.net/manual/en/streamwrapper.stream-stat.php
   */
  public function stream_stat();

  /**
   * Retrieve the current position of a stream.
   *
   * This method is called in response to fseek() to determine the current
   * position.
   *
   * @return int
   *   Should return the current position of the stream.
   *
   * @see PhpStreamWrapperInterface::stream_tell()
   * @see http://php.net/manual/en/streamwrapper.stream-tell.php
   */
  public function stream_tell();

  /**
   * Truncate stream.
   *
   * Will respond to truncation; e.g., through ftruncate().
   *
   * @param int $new_size
   *   The new size.
   *
   * @return bool
   *   TRUE on success, FALSE otherwise.
   *
   * @see ftruncate()
   * @see http://php.net/manual/en/streamwrapper.stream-truncate.php
   */
  public function stream_truncate($new_size);

  /**
   * Write to stream.
   *
   * This method is called in response to fwrite(). Remember to update the
   * current position of the stream by number of bytes that were successfully
   * written.
   *
   * @param string $data
   *   Should be stored into the underlying stream. If there is not enough room
   *   in the underlying stream, store as much as possible.
   *
   * @return int
   *   Should return the number of bytes that were successfully stored, or 0 if
   *   none could be stored.
   *
   * @see fwrite()
   * @see http://php.net/manual/en/streamwrapper.stream-write.php
   */
  public function stream_write($data);

  /**
   * Delete a file.
   *
   * This method is called in response to unlink().
   *
   * Note, in order for the appropriate error message to be returned this method
   * should not be defined if the wrapper does not support removing files.
   *
   * Note, the streamWrapper::$context property is updated if a valid context is
   * passed to the caller function.
   *
   * @param string $path
   *   The file URL which should be deleted.
   *
   * @return bool
   *   Returns TRUE on success or FALSE on failure.
   *
   * @see unlink()
   * @see PhpStreamWrapperInterface::rmdir()
   * @see http://php.net/manual/en/streamwrapper.unlink.php
   */
  public function unlink($path);

  /**
   * Retrieve information about a file.
   *
   * This method is called in response to all stat() related functions.
   *
   * Note, the streamWrapper::$context property is updated if a valid context is
   * passed to the caller function.
   *
   * @param string $path
   *   The file path or URL to stat. Note that in the case of a URL, it must be
   *   a "://" delimited URL. Other URL forms are not supported.
   * @param int $flags
   *   Holds additional flags set by the streams API. It can hold one or more
   *   of the following values ORed together:
   *   - STREAM_URL_STAT_LINK: For resources with the ability to link to other
   *     resource (such as an HTTP Location: forward, or a filesystem symlink).
   *     This flag specified that only information about the link itself should
   *     be returned, not the resource pointed to by the link. This flag is set
   *     in response to calls to lstat(), is_link(), or filetype().
   *   - STREAM_URL_STAT_QUIET: If this flag is set, your wrapper should not
   *     raise any errors. If this flag is not set, you are responsible for
   *     reporting errors using the trigger_error() function during stating of
   *     the path.
   *
   * @return array|false
   *   Should return the same as stat() does. Unknown or unavailable values
   *   should be set to a rational value (usually 0).
   *
   * @see stat()
   * @see PhpStreamWrapperInterface::stream_stat()
   * @see http://php.net/manual/en/streamwrapper.url-stat.php
   */
  public function url_stat($path, $flags);

}
