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
 * ModelTicketTypeForm.h
 * 
 * 
 */

#ifndef ModelTicketTypeForm_H_
#define ModelTicketTypeForm_H_

#include <QJsonObject>


#include <QString>

#include "SWGObject.h"

namespace api {

class ModelTicketTypeForm: public SWGObject {
public:
    ModelTicketTypeForm();
    ModelTicketTypeForm(QString* json);
    virtual ~ModelTicketTypeForm();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelTicketTypeForm* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    qint64 getComanyId();
    void setComanyId(qint64 comany_id);

    QString* getName();
    void setName(QString* name);

    QString* getDescription();
    void setDescription(QString* description);

    QString* getOrderCode();
    void setOrderCode(QString* order_code);

    QString* getSign();
    void setSign(QString* sign);

    QString* getSignForm();
    void setSignForm(QString* sign_form);

    float getPrice();
    void setPrice(float price);


private:
    qint64 id;
    qint64 comany_id;
    QString* name;
    QString* description;
    QString* order_code;
    QString* sign;
    QString* sign_form;
    float price;
};

}

#endif /* ModelTicketTypeForm_H_ */
