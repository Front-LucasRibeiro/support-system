<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Storage;

class CalledsCreatedMail extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(private string $title, private string $body, public array $attachmentPaths)
  {
    $this->title = $title;
    $this->body = $body;
    $this->attachmentPaths = $attachmentPaths;
  }

  /**
   * Get the message envelope.
   *
   * @return \Illuminate\Mail\Mailables\Envelope
   */
  public function envelope()
  {
    return new Envelope(
      subject: 'Support System - Novo chamado criado',
    );
  }

  /**
   * Get the message content definition.
   *
   * @return \Illuminate\Mail\Mailables\Content
   */
  public function content()
  {
    return new Content(
      view: 'mail.calleds-created',
      with: [
        'title' => $this->title,
        'body' => $this->body,
      ],
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array
   */
  public function attachments()
  {
    $attachments = [];

    foreach ($this->attachmentPaths as $attachment) {
      $attachmentPath = Storage::path('public/' . $attachment);
      $attachments[] = Attachment::fromPath($attachmentPath);
    }

    return $attachments;
  }

}
