/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */

/*
 * ModelTicketPrice.h
 * 
 * 
 */

#ifndef ModelTicketPrice_H_
#define ModelTicketPrice_H_

#include <QJsonObject>


#include <QDateTime>

#include "SWGObject.h"

namespace api {

class ModelTicketPrice: public SWGObject {
public:
    ModelTicketPrice();
    ModelTicketPrice(QString* json);
    virtual ~ModelTicketPrice();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelTicketPrice* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    qint64 getTicketTypeId();
    void setTicketTypeId(qint64 ticket_type_id);

    float getPrice();
    void setPrice(float price);

    QDateTime* getCreatedAt();
    void setCreatedAt(QDateTime* created_at);

    QDateTime* getUpdatedAt();
    void setUpdatedAt(QDateTime* updated_at);


private:
    qint64 id;
    qint64 ticket_type_id;
    float price;
    QDateTime* created_at;
    QDateTime* updated_at;
};

}

#endif /* ModelTicketPrice_H_ */
